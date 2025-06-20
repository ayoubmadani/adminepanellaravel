@props(['title', 'value', 'icon', 'color'])

@php
    $colorMap = [
        'blue' => 'bg-blue-100 text-blue-500',
        'green' => 'bg-green-100 text-green-500',
        'purple' => 'bg-purple-100 text-purple-500',
        'yellow' => 'bg-yellow-100 text-yellow-500',
    ];
@endphp

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">{{ $title }}</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        </div>
        <div class="w-12 h-12 {{ $colorMap[$color] ?? 'bg-gray-100 text-gray-500' }} rounded-full flex items-center justify-center">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
</div>
