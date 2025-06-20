@extends('admin.layout.main')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Add Customer</h2>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="mb-4">
            <label for="name" class="block mb-1 font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mobile --}}
        <div class="mb-4">
            <label for="mobile" class="block mb-1 font-medium text-gray-700">Mobile</label>
            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
            @error('mobile')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Wilaya using Component --}}
        <div class="mb-4">
            <label for="wilaya" class="block mb-1 font-medium text-gray-700">Wilaya</label>
            <x-wilaya-select :selected="old('wilaya')" />
            @error('wilaya')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Address --}}
        <div class="mb-4">
            <label for="address" class="block mb-1 font-medium text-gray-700">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
            @error('address')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label for="status" class="block mb-1 font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
