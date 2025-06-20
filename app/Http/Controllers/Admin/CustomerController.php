<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
    $query = Customer::query();

    // تصفية حسب المستخدم الحالي
    $query->where('user_id', Auth::id()); // هذا السطر يضمن عرض العملاء فقط للمستخدم المسجل

    // بحث بالاسم أو رقم الهاتف
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('mobile', 'like', '%' . $request->search . '%');
        });
    }

    $customers = $query->withCount([
        'orders as cancelled_orders_count' => function ($query) {
            $query->where('status', 'Cancelled');
        }
    ])->paginate(10);

    return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'wilaya' => 'required|string',
            'address' => 'required|string|max:255',
            'status' => 'required',
        ]);

        // إضافة user_id للمستخدم الحالي
        $validated['user_id'] = Auth::id();

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        // ضف المزيد حسب الحاجة
        return view('admin.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'wilaya' => 'required',
            'status' => 'required',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'تم تحديث معلومات الزبون');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'تم حذف الزبون');
    }
}
