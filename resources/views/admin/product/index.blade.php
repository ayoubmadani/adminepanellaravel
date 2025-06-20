@extends('admin.layout.main')

@section('content')
    <div class="page-transition" id="products-page">
        <div class="flex flex-wrap items-center justify-between mb-6 gap-2">
            <h1 class="text-2xl font-bold text-gray-800">Product Management</h1>
            <div class="flex gap-2">
                <a href="{{ route('products.invoice') }}" target="_blank"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 inline-flex items-center">
                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                </a>
                <a href="{{ route('products.create') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Product
                </a>
            </div>
        </div>

        <!-- ✅ Search & Filter Form -->
        <form method="GET" action="{{ route('products.index') }}"
            class="mb-6 flex flex-col md:flex-row items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or codebar"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-64" />
            <select name="category_id"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
        </form>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="h-10 w-10 object-cover rounded-md">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $product->codebar }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">${{ $product->price }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $product->stock }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->stock == 0)
                                        <span
                                            class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">Out
                                            of Stock</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">In
                                            Stock</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 flex items-center space-x-2">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="text-green-500 hover:text-green-700" title="Show">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="text-blue-500 hover:text-blue-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" onclick="printBarcode('{{ $product->codebar }}')"
                                        title="Print Barcode" class="text-gray-500 hover:text-black">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        function printBarcode(code) {
            const printWindow = window.open('', '_blank');

            const htmlContent = `
                <html>
                    <head>
                        <title>Print Barcode</title>
                        <style>
                            @media print {
                                @page {
                                    size: A6;
                                    margin: 10mm;
                                }
                                body {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 100vh;
                                    margin: 0;
                                    font-family: sans-serif;
                                }
                            }
                        </style>
                        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"><\/script>
                    </head>
                    <body>
                        <div style="text-align:center;">
                            <svg id="barcode"></svg>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                JsBarcode("#barcode", "${code}", {
                                    format: "CODE128",
                                    width: 2,
                                    height: 80,
                                    displayValue: true,
                                    fontSize: 16
                                });
                                setTimeout(function() {
                                    window.print();
                                    window.close();
                                }, 800);
                            });
                        <\/script>
                    </body>
                </html>
            `;

            printWindow.document.open();
            printWindow.document.write(htmlContent);
            printWindow.document.close();
        }
    </script>
@endsection
