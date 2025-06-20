@extends('admin.layout.main')
@section('content')
    <div class="mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Product Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <p class="mt-1 text-lg text-gray-900">{{ $product->name }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <p class="mt-1 text-lg text-gray-900">{{ $product->category->name ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <p class="mt-1 text-lg text-gray-900">${{ number_format($product->price, 2) }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Stock</label>
                <p class="mt-1 text-lg text-gray-900">{{ $product->stock }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <p class="mt-1 text-lg text-gray-900 capitalize">{{ $product->status }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Buy price</label>
                <input type="password" id="password" value="{{ $product->buyprice }}" readonly class="border-0 focus:outline-none focus:ring-0 hover:border-0">
                <button onclick="togglePassword()">👁️</button>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="mt-2 h-32 rounded">
                @else
                    <p class="mt-2 text-gray-500">No image uploaded.</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('products.edit', $product->id) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit Product</a>
        </div>
    </div>
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
@endsection
