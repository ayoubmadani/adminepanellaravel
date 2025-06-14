@extends('admin.layout.main')
@section('content')
    <div class="mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Product</h2>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
      <!-- Product Name -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Category Name *</label>
        <input type="text" name="name" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

       <!-- code bar -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Code Bar </label>
        <input type="text" name="codebar" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Description -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Description *</label>
        <textarea name="description" rows="4" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Price & Discount -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Price (DA) *</label>
          <input type="number" name="price" step="0.01" required
                 class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
         <div>
        <label class="block text-gray-700 font-semibold mb-1">Discount </label>
        <select name="category" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Select Discount --</option>
          <option value="fruits">40 %</option>
          <option value="vegetables">20%</option>
          <option value="drinks">15%</option>
        </select>
      </div>
      </div>

      <!-- Category -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Category *</label>
        <select name="category" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Select Category --</option>
          <option value="fruits">Fruits</option>
          <option value="vegetables">Vegetables</option>
          <option value="drinks">Drinks</option>
        </select>
      </div>

      <!-- Stock -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Stock Quantity *</label>
        <input type="number" name="stock" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Image -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Category Image *</label>
        <input type="file" name="image" accept="image/*" required
               class="w-full border border-gray-300 rounded-xl px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Tags -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Tags</label>
        <input type="text" name="tags" placeholder="e.g. fresh, organic"
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Status -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Status *</label>
        <select name="status" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>

      <!-- Submit -->
      <div>
        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700 transition duration-200">
          Add Category
        </button>
      </div>
    </form>
  </div>
@endsection

