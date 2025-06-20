<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // الحصول على معرف المستخدم الحالي

        return view('admin.dashboard.index', [
            'totalRevenue' => Order::where('user_id', $userId)->sum('amount'),
            'totalOrders' => Order::where('user_id', $userId)->count(),
            'totalProducts' => Product::where('user_id', $userId)->count(),
            'activeCustomers' => User::where('id', $userId)->count(), // أو عد الزبائن المرتبطين به إذا كانت لديك علاقة
            'recentOrders' => Order::with('customer')->where('user_id', $userId)->latest()->take(5)->get(),
        ]);
    }
}
