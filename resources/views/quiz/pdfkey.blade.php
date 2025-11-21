<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz: {{ $quiz->topic }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            font-size: 24px;
        }

        .quiz-details {
            margin-bottom: 20px;
        }

        .quiz-details strong {
            font-size: 18px;
        }

        .question {
            margin: 15px 0;
        }

        .question p {
            font-size: 14px;
        }

        .answer {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Quiz: {{ $quiz->topic }}</h1>
    
    <div class="quiz-details">
        <strong>Topic:</strong> {{ $quiz->topic }} <br>
        <strong>Total Questions:</strong> {{ count($questions) }}
    </div>

    <div class="questions">
        @foreach($questions as $index => $question)
            <div class="question">
                <p><strong>Question {{ $index + 1 }}:</strong> {{ $question['soal'] }}</p>
                <p><strong>Answer:</strong> {{ $question['jwb'] }}</p>
            </div>
        @endforeach
    </div>

</body>
</html>
