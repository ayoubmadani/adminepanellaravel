@extends('admin.layout.main')
@section('content')
    <div class="page-transition" id="orders-page">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Order Management</h1>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-download mr-2"></i> Export
                </button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="fas fa-plus mr-2"></i> Create Order
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <div class="mb-4 md:mb-0">
                    <div class="relative">
                        <input
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-64"
                            placeholder="Search orders..." type="text">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Processing</option>
                        <option>Shipped</option>
                        <option>Delivered</option>
                        <option>Cancelled</option>
                    </select>
                    <input
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        type="date">
                </div>
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
                                Actions
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
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="showOrderDetails()"><i
                                        class="fas fa-eye"></i></button>
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
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="showOrderDetails()"><i
                                        class="fas fa-eye"></i></button>
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
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Shipped</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{route('admin.orderDetails')}}">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="">

                                         <i class="fas fa-eye"></i>

                                </button>
                                </a>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-2023-004</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Emma Wilson</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-12</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$78.30</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="showOrderDetails()"><i
                                        class="fas fa-eye"></i></button>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-2023-005</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">David Lee</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-06-11</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$156.80</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Pending</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="showOrderDetails()"><i
                                        class="fas fa-eye"></i></button>
                                <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="text-sm text-gray-500">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                        class="font-medium">18</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
