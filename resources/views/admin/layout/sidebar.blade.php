<div class="sidebar fixed h-full w-64 bg-white shadow-lg z-10">
    <div class="p-5 flex items-center space-x-3 border-b border-gray-200">
        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
            <i class="fas fa-store text-white"></i>
        </div>
        <span class="logo-text text-xl font-semibold text-gray-800">ShopAdmin</span>
    </div>
    <div class="p-4">
        <div class="text-xs uppercase text-gray-500 font-medium mb-3">Main Menu</div>
        <ul class="space-y-2">
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('admin.dashboard') }}" onclick="showPage('dashboard')">
                    <i class="fas fa-tachometer-alt w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('categorys.index') }}" onclick="showPage('categories')">
                    <i class="fas fa-tags w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Category</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('products.index') }}" onclick="showPage('products')">
                    <i class="fas fa-box-open w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Products</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('discounts.index') }}" onclick="showPage('categories')">
                    <i class="fa-solid fa-percent w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Discount</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('orders.index') }}" onclick="showPage('orders')">
                    <i class="fas fa-shopping-cart w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Orders</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('settings.index') }}" onclick="showPage('settings')">
                    <i class="fas fa-cog w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Settings</span>
                </a>
            </li>
        </ul>

        <div class="text-xs uppercase text-gray-500 font-medium mb-3 mt-6">Reports</div>
        <ul class="space-y-2">
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="#">
                    <i class="fas fa-chart-line w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Sales</span>
                </a>
            </li>
            <li>
                <a class="nav-item flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-200"
                    href="{{ route('customers.index') }}">
                    <i class="fas fa-users w-5 text-gray-500"></i>
                    <span class="nav-text ml-3">Customers</span>
                </a>
            </li>



            {{-- logout --}}
            <div class="text-xs uppercase text-gray-500 font-medium mb-4   mt-9">logout</div>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full nav-item flex items-center p-2 text-white bg-red-500 rounded-lg hover:bg-red-700 transition duration-200">
                        <i class="fa-solid fa-right-from-bracket w-5"></i>
                        <span class="nav-text ml-3">Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>



