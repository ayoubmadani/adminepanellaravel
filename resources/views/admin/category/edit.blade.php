@extends('admin.layout.main')

@section('content')
    <div class="page-transition" id="edit-category-page">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Category</h1>
            <a href="{{ route('categorys.index') }}" class="text-blue-500 hover:underline">← Back to Categories</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <form method="POST" action="{{ route('categorys.update', $category->id) }}">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        value="{{ old('name', $category->name) }}" required>

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tag --}}
                <div class="mb-4">
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                    <input type="text" name="tag" id="tag"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tag') border-red-500 @enderror"
                        value="{{ old('tag', $category->tag) }}">

                    @error('tag')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
