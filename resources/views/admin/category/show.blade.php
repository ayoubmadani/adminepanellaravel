@extends('admin.layout.main')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Category Details</h2>

    <div class="mb-4">
        <strong>Name:</strong>
        <p>{{ $category->name }}</p>
    </div>

    <div class="mb-4">
        <strong>Tag:</strong>
        <p>{{ $category->tag }}</p>
    </div>

    <div class="mb-4">
        <strong>Status:</strong>
        <p>{{ $category->status ? 'Active' : 'Inactive' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('categorys.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Back to List
        </a>
    </div>
</div>
@endsection
