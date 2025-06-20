@extends('admin.layout.main')
@section('content')
    <div class="mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Discount</h2>

     <form action="{{ route('discounts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf
        <!-- Product Name -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Discount Name *</label>
        <input type="text" name="name" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

       <!-- Discount -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Discount </label>
        <input type="text" name="discount" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Description -->
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Description *</label>
        <textarea name="description" rows="4"
                  class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- date  -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Date Begin *</label>
          <input type="date" name="dateBegin" step="0.01" required
                 class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label class="block text-gray-700 font-semibold mb-1">Date Fin *</label>
          <input type="date" name="dateFin" step="0.01" required
                 class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
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
          Add Product
        </button>
      </div>
    </form>
  </div>
@endsection

