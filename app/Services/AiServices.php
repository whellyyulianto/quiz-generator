<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiServices
{
    public function generateQuiz($topic, $difficulty)
    {
        $prompt = "
        Kembalikan **hanya JSON array** tanpa kata tambahan.

        Format:
        [
            {
                \"soal\": \"...\",
                \"opsi\": {
                    \"A\": \"...\",
                    \"B\": \"...\",
                    \"C\": \"...\",
                    \"D\": \"...\"
                },
                \"jwb\": \"A\"
            }
        ]

        Topik: $topic
        Kesulitan soal: $difficulty
        Minimal 10 soal
        ";

        $response = Http::withToken(env('GROQ_API_KEY'))->post(
            "https://api.groq.com/openai/v1/chat/completions",
            [
                "model" => "llama-3.1-8b-instant",
                "messages" => [
                    ["role" => "user", "content" => $prompt]
                ]
            ]
        );

        $json = $response->json();

        if (!isset($json['choices'][0]['message']['content'])) {
            throw new \Exception("Groq Error: " . json_encode($json));
        }

        $content = $json['choices'][0]['message']['content'];

        
        $start = strpos($content, '[');
        $end   = strrpos($content, ']');

        if ($start === false || $end === false) {
            throw new \Exception("Tidak ditemukan JSON array dalam response: $content");
        }

        $clean = substr($content, $start, $end - $start + 1);

        // perbaikan karakter kutip AI
        $clean = str_replace(["“", "”"], "\"", $clean);

        // decode JSON
        $data = json_decode($clean, true);

        if (!$data) {
            throw new \Exception("JSON Decode Error. Raw content: " . $clean);
        }

        $normalized = [];

        foreach ($data as $q) {
            $normalized[] = [
                'soal' => $q['soal'] ?? $q['question'] ?? '',
                'opsi' => $q['opsi'] ?? $q['options'] ?? [],
                'jwb'  => $q['jwb'] ?? $q['answer'] ?? '',
            ];
        }

        return $normalized;
    }

}
