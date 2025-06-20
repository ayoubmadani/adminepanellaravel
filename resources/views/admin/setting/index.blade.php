@extends('admin.layout.main')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">إعدادات المتجر</h2>
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">اسم المتجر</label>
                <input type="text" name="name" value="{{ old('name', $store->name ?? '') }}"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email', $store->email ?? '') }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone', $store->phone ?? '') }}"
                    class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">العنوان</label>
                <textarea name="address" rows="3" class="w-full border px-3 py-2 rounded">{{ old('address', $store->address ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">شعار المتجر</label>
                <input type="file" name="logo" class="w-full">
                @if($store && $store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" class="mt-2 w-24 h-24 object-cover rounded">
                @endif
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                حفظ التغييرات
            </button>
        </form>
    </div>
@endsection
