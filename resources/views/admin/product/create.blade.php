@extends('admin.layout.main')

@section('content')
    <div class="page-transition">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Product</h1>
        </div>


        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            @csrf
            <div class="space-y-6">
                {{-- name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- brand --}}
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('brand')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- price --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Sale Price</label>
                    <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- buyprice --}}
                <div>
                    <label for="buyprice" class="block text-sm font-medium text-gray-700 mb-1">Buy Price</label>
                    <input type="number" name="buyprice" id="buyprice" step="0.01" value="{{ old('buyprice') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('buyprice')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- stock --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('stock')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- No category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- discount --}}
                <div>
                    <label for="discount_id" class="block text-sm font-medium text-gray-700 mb-1">Discount</label>
                    <select name="discount_id" id="discount_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- No discount --</option>
                        @foreach ($discounts as $discount)
                            <option value="{{ $discount->id }}"
                                {{ old('discount_id') == $discount->id ? 'selected' : '' }}>
                                {{ $discount->name }} ({{ $discount->discount }}%)
                            </option>
                        @endforeach
                    </select>
                    @error('discount_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- codebar --}}
                <div class="mb-4">
                    <label for="codebar" class="block text-sm font-medium text-gray-700 mb-2">Codebar</label>

                    <div class="flex space-x-2">
                        <input type="text" name="codebar" id="codebar" value="{{ old('codebar') }}"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter or generate barcode">

                        <button type="button" onclick="generateBarcode()"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Generate
                        </button>
                    </div>

                    @error('codebar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- tags --}}
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                        placeholder="e.g. apple,organic"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('tags')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        onchange="previewImage(event)">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mt-4">
                        <img id="preview" src="#" alt="Image preview"
                            class="hidden w-40 h-40 object-cover rounded-lg border border-gray-300">
                    </div>
                </div>

                {{-- status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                    Save Product
                </button>
            </div>
        </form>
    </div>

    {{-- Image preview script --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function generateBarcode(length = 13) {
            let barcode = '';
            for (let i = 0; i < length; i++) {
                barcode += Math.floor(Math.random() * 10);
            }
            document.getElementById('codebar').value = barcode;
        }
    </script>
@endsection
