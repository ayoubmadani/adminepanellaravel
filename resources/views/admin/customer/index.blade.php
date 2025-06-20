@extends('admin.layout.main')

@section('content')
    <div class="page-transition p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Customer Management</h1>
            <a href="{{ route('customers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i> Add Customer
            </a>
        </div>

        <form method="GET" class="mb-4 flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or mobile"
                class="w-full md:w-64 px-4 py-2 border rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" />



            <button type="submit" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Filter
            </button>
        </form>

        <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Name</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Mobile</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Wilaya</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Address</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Cancelled Orders</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-600">Actions</th>


                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($customers as $customer)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->mobile }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->wilaya }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->address }}</td>
                            <td class="px-6 py-4 text-sm text-red-700">{{ $customer->cancelled_orders_count }}</td>

                            <td class="px-6 py-4 text-sm">
                                @if($customer->status)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
                               <a href="{{ route('orders.index', ['customer' => $customer->name]) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="{{ route('orders.create', ['customer_id' => $customer->id]) }}"
                                    class="text-indigo-500 hover:text-indigo-700">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
@endsection
