<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Generator</title>
    @vite('resources/css/app.css')

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/umd/outline.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto px-6 py-10">
        @yield('content')
    </div>

    {{-- Tempat untuk scripts tambahan --}}
    @stack('scripts')

</body>
</html>
