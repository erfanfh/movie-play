<?php

namespace App\Actions\Answers;

use App\Actions\Action;

class checkAnswer extends Action
{
    public function handle($answer, $question): float|int
    {
        $userAnswer = preg_replace('/\b(the|a|an)\b/', '', strtolower(trim($answer)));

        $userAnswer = preg_replace('/[^a-z0-9]/', '', $userAnswer);

        $correctAnswer = preg_replace('/\b(the|a|an)\b/', '', strtolower(trim($question)));

        $correctAnswer = preg_replace('/[^a-z0-9]/', '', $correctAnswer);

        $distance = levenshtein($correctAnswer, $userAnswer);

        $maxLen = max(strlen($correctAnswer), strlen($userAnswer));

        return 1 - ($distance / $maxLen);
    }
}
