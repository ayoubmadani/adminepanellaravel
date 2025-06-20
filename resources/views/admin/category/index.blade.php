@extends('admin.layout.main')

@section('content')
    <div class="page-transition" id="categories-page">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Category Management</h1>
            <a href="{{ route('categorys.create') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="fas fa-plus mr-2"></i> Add Category
                </button>
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
            <div class="mb-4">
                <div class="relative">
                    <input
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-64"
                        placeholder="Search categories..." type="text">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"># Products</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sold</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categorys as $index => $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->status)
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $category->products_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700">
                                    {{ $category->total_quantity_sold ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('categorys.show', $category->id) }}" class="text-green-500 hover:text-green-700 mr-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('categorys.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('categorys.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($categorys->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">No categories found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $categorys->links() }}
            </div>
        </div>
    </div>
@endsection
