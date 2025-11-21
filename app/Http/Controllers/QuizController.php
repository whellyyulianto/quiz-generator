<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Services\AiServices;
use Barryvdh\DomPDF\Facade\Pdf;

class QuizController extends Controller
{
    public function index() {
        return view('quiz.index');
    }

    public function generate(Request $request, AiServices $ollama) {
        $request->validate([
            'topic' => 'required',
            'difficulty' => 'required',
        ]);

        $json = $ollama->generateQuiz($request->topic, $request->difficulty);

        $quiz = Quiz::create([
            'topic' => $request->topic,
            'questions' => $json
        ]);

        return redirect()->route('quiz.show', $quiz->id);
    }

    public function show(Quiz $quiz) {
        $questions = $quiz->questions;
        // dd($quiz->questions);
        return view('quiz.show', compact('quiz', 'questions'));
    }

    public function store(Request $request)
    {
        $ai = new AiServices();
        $quizData = $ai->generateQuiz($request->topic, $request->difficulty);

        Quiz::create([
            'topic' => $request->topic,
            'questions' => $quizData, // Laravel auto JSON encode
        ]);

        return back()->with('success', 'Quiz berhasil dibuat!');
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $jawabanUser = $request->input('answer', []); // default kosong
        $questions   = $quiz->questions; // array list soal

        $benar = 0;

        foreach ($questions as $index => $q) {

            if (
                isset($jawabanUser[$index]) &&
                isset($q['jwb']) &&
                $jawabanUser[$index] == $q['jwb']
            ) {
                $benar++;
            }
        }
        return back()->with('success', "Nilai kamu: $benar / " . count($questions));
    }

    public function exportPdf(Quiz $quiz)
    {
        // Get the quiz questions
        $questions = $quiz->questions;

        // Prepare the view for the PDF
        $pdf = Pdf::loadView('quiz.pdf', compact('quiz', 'questions'));

        // Return the generated PDF as a download
        return $pdf->download("quiz_{$quiz->id}.pdf");
    }

    public function exportKeyPdf(Quiz $quiz)
    {
        // Get the quiz questions
        $questions = $quiz->questions;

        // Prepare the view for the PDF
        $pdf = Pdf::loadView('quiz.pdfkey', compact('quiz', 'questions'));

        // Return the generated PDF as a download
        return $pdf->download("quiz_answer_{$quiz->id}.pdf");
    }


}
