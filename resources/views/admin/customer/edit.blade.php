@extends('admin.layout.main')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Edit Customer</h2>

        <form method="POST" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                    class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mobile --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Mobile</label>
                <input type="text" name="mobile" value="{{ old('mobile', $customer->mobile) }}"
                    class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring @error('mobile') border-red-500 @enderror">
                @error('mobile')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Wilaya --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Wilaya</label>
                <x-wilaya-select :selected="old('wilaya', $customer->wilaya ?? '')" />
                @error('wilaya')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Address --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ old('address', $customer->address) }}"
                    class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring @error('address') border-red-500 @enderror">
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Status</label>
                <select name="status"
                    class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring @error('status') border-red-500 @enderror">
                    <option value="0" {{ old('status', $customer->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ old('status', $customer->status) == 1 ? 'selected' : '' }}>Active</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Customer
                </button>
            </div>
        </form>
    </div>
@endsection
