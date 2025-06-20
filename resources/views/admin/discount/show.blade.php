@extends('admin.layout.main')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Discount Details</h1>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">Name</label>
        <p class="text-gray-800">{{ $discount->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">Discount Percentage</label>
        <p class="text-gray-800">{{ $discount->percentage }} %</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">Description</label>
        <p class="text-gray-800">{{ $discount->description }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">Start Date</label>
        <p class="text-gray-800">{{ $discount->start_date }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">End Date</label>
        <p class="text-gray-800">{{ $discount->end_date }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-gray-600 font-semibold">Status</label>
        @if($discount->status)
            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
        @else
            <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('discounts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
            Back to Discounts
        </a>
    </div>
</div>
@endsection
