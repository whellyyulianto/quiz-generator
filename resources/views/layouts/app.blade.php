<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Generator</title>

    {{-- Tailwind CDN (boleh diganti dengan Vite jika sudah setup) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/dist/umd/outline.js"></script>

</head>
<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Quiz App</h1>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4">
        @yield('content')
    </main>
    @stack('scripts')

</body>
</html>
