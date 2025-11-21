@extends('layout')

@section('content')

<div class="flex justify-center items-center min-h-[70vh]">
    <div class="w-full max-w-xl">

        <h1 class="text-3xl font-bold mb-6 text-center">AI Quiz Generator</h1>

        <form action="{{ route('quiz.generate') }}" 
              method="POST" 
              id="quizForm"
              class="bg-white p-6 rounded-lg shadow-lg">
            
            @csrf

            <label class="block mb-2 font-semibold">Topik Soal</label>
            <input type="text" name="topic" required
                class="w-full p-2 border rounded mb-4"
                placeholder="Contoh: Sistem Operasi">

            <label class="block mb-2 font-semibold">Tingkat Kesulitan</label>
            <select name="difficulty" class="w-full p-2 border rounded mb-6">
                <option value="mudah">Mudah</option>
                <option value="sedang">Sedang</option>
                <option value="sulit">Sulit</option>
            </select>

            <button type="submit" 
                id="submitBtn"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full font-semibold">
                Generate Quiz
            </button>

            {{-- LOADER --}}
            <div id="loader" class="hidden text-center mt-4">
                <div class="flex justify-center gap-2">
                    <div class="w-4 h-4 bg-blue-600 rounded-full animate-bounce"></div>
                    <div class="w-4 h-4 bg-blue-600 rounded-full animate-bounce [animation-delay:0.2s]"></div>
                    <div class="w-4 h-4 bg-blue-600 rounded-full animate-bounce [animation-delay:0.4s]"></div>
                </div>
                <p class="mt-2 font-medium text-gray-700">
                    AI sedang membuat soal...
                </p>
            </div>

        </form>

    </div>
</div>


{{-- SCRIPT LOADER --}}
<script>
    const form = document.getElementById('quizForm');
    const button = document.getElementById('submitBtn');
    const loader = document.getElementById('loader');

    form.addEventListener('submit', function() {
        button.disabled = true;
        button.innerText = "Memproses...";
        loader.classList.remove('hidden');
    });
</script>

@endsection
