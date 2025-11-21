<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [QuizController::class, 'index']);
Route::post('/generate', [QuizController::class, 'generate'])->name('quiz.generate');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz}/export-pdf', [QuizController::class, 'exportPdf'])->name('quiz.exportPdf');
Route::get('/quiz/{quiz}/export-answer-pdf', [QuizController::class, 'exportKeyPdf'])->name('quiz.exportKeyPdf');