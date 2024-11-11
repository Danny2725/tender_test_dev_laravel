<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Custom CSS & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-primary text-white py-3">
            <div class="container text-center">
                <h1 class="h5 mb-0">{{ $header }}</h1>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 border-top mt-auto">
        <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>