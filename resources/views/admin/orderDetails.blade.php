@extends('admin.layout.main')
@section('content')
    <div class="page-transition" id="order-details-page">
        <div class="flex items-center justify-between mb-6">
            <div>
                <button class="text-blue-500 hover:text-blue-700 mr-4" onclick="showPage('orders')">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Orders
                </button>
                <h1 class="text-2xl font-bold text-gray-800 inline-block">Order #ORD-2023-002</h1>
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-print mr-2"></i> Print
                </button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="fas fa-truck mr-2"></i> Update Status
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qty
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-md bg-gray-200"></div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Wireless Headphones</div>
                                                <div class="text-sm text-gray-500">SKU: HP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$89.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$89.99</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-md bg-gray-200"></div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Leather Wallet</div>
                                                <div class="text-sm text-gray-500">SKU: WL-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$45.50</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$45.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Notes</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-gray-500 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">Customer requested gift wrapping for the
                                    headphones.</p>
                                <p class="text-xs text-gray-500 mt-1">Added by Sarah Johnson on 2023-06-14</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-store text-blue-500 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">Order is being processed and will be shipped within
                                    24 hours.</p>
                                <p class="text-xs text-gray-500 mt-1">Added by Admin on 2023-06-14</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Add a note..." rows="3"></textarea>
                        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Add
                            Note
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-800">$135.49</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-gray-800">$5.99</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="text-gray-800">$12.45</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-3">
                            <span class="text-gray-800 font-semibold">Total</span>
                            <span class="text-gray-800 font-semibold">$153.93</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Contact Information</h3>
                            <p class="text-sm text-gray-600 mt-1">Sarah Johnson</p>
                            <p class="text-sm text-gray-600">sarah.johnson@example.com</p>
                            <p class="text-sm text-gray-600">+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Shipping Address</h3>
                            <p class="text-sm text-gray-600 mt-1">123 Main Street</p>
                            <p class="text-sm text-gray-600">Apt 4B</p>
                            <p class="text-sm text-gray-600">New York, NY 10001</p>
                            <p class="text-sm text-gray-600">United States</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Billing Address</h3>
                            <p class="text-sm text-gray-600 mt-1">Same as shipping address</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Information</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method</span>
                            <span class="text-gray-800">Credit Card (Visa)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Transaction ID</span>
                            <span class="text-gray-800">ch_1J4jk2KZvKYlo2Ck</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Status</span>
                            <span class="text-green-600 font-medium">Paid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
