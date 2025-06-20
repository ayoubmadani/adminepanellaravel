@extends('admin.layout.main')

@section('content')
    <div class="page-transition" id="order-details-page">
        <div class="flex space-x-2">
            <!-- زر تحميل الفاتورة PDF -->
            <a href="{{ route('admin.orders.invoice.pdf', $order) }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                <i class="fas fa-print mr-1"></i> Print Invoice
            </a>

            <!-- زر تعديل الطلب -->
            <a href="{{ route('orders.edit', $order->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                <i class="fas fa-edit mr-1"></i> Modify Order
            </a>

            <!-- تغيير الحالة -->
            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
    @csrf
    <select name="status"
            onchange="this.form.submit()"
            class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm
                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
            aria-label="Change order status">
        @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</form>
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
                                        Image</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qty</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image"
                                                class="h-10 w-10 rounded">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->product->name ?? 'N/A' }}</div>

                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($item->price, 2) }} DZD
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ number_format($item->price * $item->quantity, 2) }} DZD</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Notes</h2>
                    <p class="text-sm text-gray-600">No notes available.</p>
                </div>
            </div>

            <div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-800">{{ number_format($order->amount, 2) }} DZD</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-3">
                            <span class="text-gray-800 font-semibold">Total</span>
                            <span class="text-gray-800 font-semibold">{{ number_format($order->amount, 2) }} DZD</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Contact Information</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $order->customer->name ?? 'Unknown' }}</p>
                            <p class="text-sm text-gray-600">{{ $order->customer->email ?? '' }}</p>
                            <p class="text-sm text-gray-600">{{ $order->customer->phone ?? '' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Shipping Address</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $order->customer->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
