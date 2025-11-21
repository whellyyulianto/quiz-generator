@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <a href="{{ url('/') }}" class="flex items-center text-blue-600 hover:text-blue-800 mb-4">
    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 19l-7-7 7-7" />
    </svg>
    <span class="font-medium">Kembali</span>
</a>
    <h1 class="text-3xl font-bold mb-6">Quiz: {{ $quiz->topic }}</h1>

    <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
        @csrf

        @php
            $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
        @endphp

        @foreach ($questions as $idx => $q)
            <div class="bg-white p-6 rounded-xl shadow mb-6 border border-gray-200">

                <h2 class="text-lg font-semibold mb-3">
                    {{ $idx + 1 }}. {{ $q['soal'] }}
                </h2>

                <div class="space-y-2">
                    @foreach ($q['opsi'] as $i => $opt)
                        @php $letter = $i; @endphp

                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                            <input
                                type="radio"
                                name="answer[{{ $idx }}]"
                                value="{{ $letter }}"
                                class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                            >
                            <span class="ml-3 text-gray-700">
                                <strong>{{ $letter }}.</strong> {{ $opt }}
                            </span>
                        </label>
                    @endforeach
                </div>

            </div>
        @endforeach

        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition"
        >
            Selesai & Lihat Hasil
        </button>
        <div class="mt-6">
            <a href="{{ route('quiz.exportPdf', $quiz->id) }}" 
            class="w-full bg-gray-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-gray-700 transition block text-center">
                Export as PDF
            </a>
        </div>
        <div class="mt-6">
            <a href="{{ route('quiz.exportKeyPdf', $quiz->id) }}" 
            class="w-full bg-gray-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-gray-700 transition block text-center">
                Export as Correct Answer PDF
            </a>
        </div>

    </form>

</div>
@endsection

@push('scripts')
@if (session('success'))
    <script>
        Swal.fire({
            title: 'Hasil Quiz',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/";
            }
        });
    </script>
@endif
@endpush