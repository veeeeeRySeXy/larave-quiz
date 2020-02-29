<?php

namespace Saritasa\LaravelQuiz\Models\Helpers;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Contracts\IQuiz;
use Saritasa\LaravelQuiz\Models\Quizzes\Quiz;

/**
 * Helper for questions which is exists as part of the quiz.
 *
 * @property-read Quiz $quiz Quiz
 */
trait PartOfQuiz
{
    /**
     * Returns quiz relation.
     *
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuiz(): IQuiz
    {
        return $this->quiz;
    }

    /**
     * {@inheritDoc}
     */
    public function isCouldBeAnswered(CanAnswerQuestions $user): bool
    {
        $userQuiz = $this->getQuiz()->getQuizForUser($user);

        return $userQuiz && $userQuiz->isValid();
    }
}
