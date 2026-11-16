<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Dapur Ayam Geprek</title>
    @include('layouts.admin.css')
</head>
<body>
    <!-- Partial Sidebar -->
    @include('layouts.admin.sidebar')

    <div class="main-wrapper">
        <!-- Partial Header -->
        @include('layouts.admin.header')

        <!-- Konten Dinamis Halaman -->
        <main class="p-4 flex-grow-1">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Partial Footer -->
        @include('layouts.admin.footer')
    </div>

    @include('layouts.admin.js')
</body>
</html>