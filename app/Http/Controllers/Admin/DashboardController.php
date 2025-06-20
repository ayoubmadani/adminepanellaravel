<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalRevenue' => Order::sum('amount'),
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'activeCustomers' => User::count(), // يمكنك تخصيصه مثلاً بشرط `->where('active', 1)`
            'recentOrders' => Order::with('customer')->latest()->take(5)->get(),
        ]);
    }
}
