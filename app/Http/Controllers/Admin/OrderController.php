<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');

        // فلترة باسم العميل
        if ($request->filled('customer')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        // فلترة بالحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فلترة بالتاريخ
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $products = Product::where('user_id', auth()->id())->get();
        $defaultName = '';
        $defaultPhone = '';
        $defaultWilaya = '';
        $customerId = null;

        if ($request->has('customer_id')) {
            $customer = \App\Models\Customer::find($request->customer_id);
            if ($customer) {
                $defaultName = $customer->name;
                $defaultPhone = $customer->mobile;
                $defaultWilaya = $customer->wilaya ?? '';
                $customerId = $customer->id;
            }
        }

        return view('admin.order.create', compact(
            'products',
            'defaultName',
            'defaultPhone',
            'defaultWilaya',
            'customerId'
        ));
    }



    public function store(Request $request)
    {
        // dd($request->all());
        // التحقق من البيانات
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;

        // حساب المبلغ الإجمالي
        foreach ($request->products as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'status' => 'pending',
            'amount' => $totalAmount,
            'date' => Carbon::now()->toDateTimeString(),
            'amount' => $totalAmount,
        ]);


        // إضافة المنتجات (عناصر الطلب)
        foreach ($request->products as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'order_id' => $order->id, // ✅ المفتاح الأساسي للطلب الجديد
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'تم إنشاء الطلب بنجاح.');
    }


    public function show($id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }


    public function edit(Order $order)
    {
        $order->load('items');
        $products = Product::all();
        return view('admin.order.edit', compact('order', 'products'));
    }

   public function update(Request $request, Order $order)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // حساب المبلغ الإجمالي الجديد
        $totalAmount = 0;
        foreach ($request->products as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // تحديث الطلب
        $order->update([
            'amount' => $totalAmount,
            'status' => $request->status ?? $order->status,
            'date' => now(),
        ]);

        // حذف العناصر القديمة
        $order->items()->delete();

        // إضافة العناصر الجديدة
        foreach ($request->products as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'order_id' => $order->id_order_items, // تأكد أن هذا الحقل موجود في جدول order_items
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'تم تحديث الطلب بنجاح.');
    }

    public function invoice(Order $order)
    {
        // تحميل العلاقات المطلوبة لتفادي مشكلة N+1
        $order->load('items.product', 'customer');
        return view('admin.order.invoice', compact('order'));
    }


    public function invoicePdf(Order $order)
    {
        // تحميل العلاقات المرتبطة (المنتجات والعميل)
        $order->load(['items.product', 'customer']);

        // تحميل الفاتورة إلى PDF
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

        // إعادة الملف بصيغة PDF مع اسم واضح
        return $pdf->download('invoice_order_' . $order->id_order_items . '.pdf');
    }
}
