<?php

namespace Saritasa\LaravelQuiz\Services;

use Saritasa\LaravelQuiz\Contracts\HasScore;
use Saritasa\LaravelQuiz\Contracts\IQuizScoreService;
use Saritasa\LaravelQuiz\Models\AnswerOption;

/**
 * Business-logic service for checks or calculates answers on quiz questions.
 */
class QuizScoreService implements IQuizScoreService
{
    /**
     * {@inheritdoc}
     */
    public function calculate(HasScore $userQuiz): float
    {
        $correctAnswersCount = 0;

        $answers = $userQuiz->getAnswers();

        foreach ($userQuiz->getQuestions() as $question) {
            if ($question->isAnswersCorrect($answers->where(AnswerOption::QUESTION_ID, '=', $question->id))) {
                $correctAnswersCount++;
            }
        }

        return round(($correctAnswersCount / $userQuiz->getQuestions()->count()) * 100);
    }
}
