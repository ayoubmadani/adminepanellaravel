@extends('admin.layout.main')

@section('content')
    <div class="mx-auto mt-10 bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Category</h2>

        <form action="{{ route('categorys.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tag --}}
            <div class="mb-4">
                <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                <input type="text" name="tag" id="tag"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tag') border-red-500 @enderror"
                    value="{{ old('tag') }}" >

                @error('tag')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <a href="{{ route('categorys.index') }}"
                   class="mr-3 text-sm text-gray-500 hover:underline">Cancel</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600">Save</button>
            </div>


        </form>
    </div>
@endsection
