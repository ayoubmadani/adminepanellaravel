@extends('admin.layout.main')
@section('content')
<div class="mx-auto bg-white p-8 rounded-2xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Discount</h2>

    <form action="{{ route('discounts.update', $discount->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Discount Name *</label>
            <input type="text" name="name" value="{{ old('name', $discount->name) }}" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Discount -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Discount</label>
            <input type="text" name="discount" value="{{ old('discount', $discount->discount) }}" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description *</label>
            <textarea name="description" rows="4" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $discount->description) }}</textarea>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Date Begin *</label>
                <input type="date" name="dateBegin" value="{{ old('dateBegin', $discount->datebegin) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Date Fin *</label>
                <input type="date" name="dateFin" value="{{ old('dateFin', $discount->datefin) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Status *</label>
            <select name="status"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="1" {{ $discount->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $discount->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700 transition duration-200">
                Update Discount
            </button>
        </div>
    </form>
</div>
@endsection
