@extends('admin.layout.main')
@section('content')
    <div class="page-transition" id="dashboard-page">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-download mr-2"></i> Export
                    </button>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        <i class="fas fa-plus mr-2"></i> Add New
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Revenue</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">$24,780</h3>
                            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% from last
                                month</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-blue-500"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Orders</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">1,245</h3>
                            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.2% from last
                                month</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-green-500"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Products</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">856</h3>
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-arrow-down mr-1"></i> 3.4% from last
                                month</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box-open text-purple-500"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Customers</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">5,342</h3>
                            <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 15.7% from last
                                month</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-yellow-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
                    <a class="text-blue-500 text-sm hover:underline" href="#" onclick="showPage('orders')">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-2023-001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Smith</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-15</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$125.00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-2023-002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Johnson</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-14</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$89.50</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-2023-003</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Michael Brown</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-13</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$245.75</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Top Selling Products</h2>
                        <a class="text-blue-500 text-sm hover:underline" href="#" onclick="showPage('products')">View
                            All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-200 flex-shrink-0"></div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-sm font-medium text-gray-800">Wireless Headphones</h4>
                                <p class="text-xs text-gray-500">Electronics</p>
                            </div>
                            <div class="text-sm font-medium text-gray-800">$89.99</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-200 flex-shrink-0"></div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-sm font-medium text-gray-800">Leather Wallet</h4>
                                <p class="text-xs text-gray-500">Accessories</p>
                            </div>
                            <div class="text-sm font-medium text-gray-800">$45.50</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-md bg-gray-200 flex-shrink-0"></div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-sm font-medium text-gray-800">Smart Watch</h4>
                                <p class="text-xs text-gray-500">Electronics</p>
                            </div>
                            <div class="text-sm font-medium text-gray-800">$199.99</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                        <a class="text-blue-500 text-sm hover:underline" href="#">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-plus text-blue-500 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">New customer registered: <span class="font-medium">Emma Wilson</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shopping-cart text-green-500 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">New order received: <span class="font-medium">#ORD-2023-004</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">4 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-box-open text-purple-500 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">New product added: <span class="font-medium">Bluetooth Speaker</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
