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
        $query = Order::with('customer')
            ->where('user_id', auth()->id()); // ✅ عرض الطلبات الخاصة بالمستخدم فقط

        if ($request->filled('customer')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

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
    // تحقق من صحة البيانات
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.price' => 'required|numeric|min:0',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    $totalAmount = 0;

    foreach ($request->items as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // إنشاء الطلب
    $order = Order::create([
        'user_id' => auth()->id(),
        'customer_id' => $request->customer_id,
        'status' => 'pending',
        'amount' => $totalAmount,
        'date' => Carbon::now()->toDateTimeString(),
    ]);

    // إضافة عناصر الطلب
    foreach ($request->items as $item) {
        $order->items()->create([
            'product_id' => $item['product_id'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'تم إنشاء الطلب بنجاح.');
}


    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['customer', 'items.product']);
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
        // dd($request->all());
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

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // حذف العناصر التابعة للطلب إن وجدت
        $order->items()->delete();

        // حذف الطلب
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
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
