<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.head')
</head>
<body class="bg-gray-50 font-sans">
<!-- Sidebar -->
@include('admin.layout.sidebar')

<!-- Main Content -->
<div class="content-area ml-64 min-h-screen">
    <!-- Top Navigation -->
    {{-- @include('admin.layout.topbar') --}}

    <!-- Page Content -->
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
