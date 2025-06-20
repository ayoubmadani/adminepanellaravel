@extends('admin.layout.main')

@section('content')
    <div class="page-transition">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
        </div>

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
                <strong>There were some problems with your input:</strong>
                <ul class="mt-2 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- brand --}}
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('brand') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- price --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Sale Price</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- buy price --}}
                <div>
                    <label for="buyprice" class="block text-sm font-medium text-gray-700 mb-1">Buy Price</label>
                    <input type="number" name="buyprice" step="0.01" value="{{ old('buyprice', $product->buyprice) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('buyprice') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- stock --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">-- No category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- discount --}}
                <div>
                    <label for="discount_id" class="block text-sm font-medium text-gray-700 mb-1">Discount</label>
                    <select name="discount_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">-- No discount --</option>
                        @foreach($discounts as $discount)
                            <option value="{{ $discount->id }}" {{ old('discount_id', $product->discount_id) == $discount->id ? 'selected' : '' }}>
                                {{ $discount->name }} ({{ $discount->discount }}%)
                            </option>
                        @endforeach
                    </select>
                    @error('discount_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- codebar --}}
                <div>
                    <label for="codebar" class="block text-sm font-medium text-gray-700 mb-1">Codebar</label>
                    <input type="text" name="codebar" value="{{ old('codebar', $product->codebar) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('codebar') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- tags --}}
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <input type="text" name="tags" value="{{ old('tags', $product->tags) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @error('tags') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           onchange="previewImage(event)"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror

                    {{-- preview current image --}}
                    <div class="mt-4">
                        <img id="preview" src="{{ asset('storage/' . $product->image) }}" alt="Current image"
                             class="w-40 h-40 object-cover rounded-lg border border-gray-300">
                    </div>
                </div>

                {{-- status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                    Update Product
                </button>
            </div>
        </form>
    </div>

    {{-- JavaScript to preview image --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
