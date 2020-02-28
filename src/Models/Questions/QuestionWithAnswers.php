<?php

namespace LaravelQuiz\Models\Questions;

use App\Models\Enums\QuestionTypes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use LaravelQuiz\Contracts\CanAnswerQuestions;
use LaravelQuiz\Contracts\HasAnswerOptions as HasAnswerOptionsContract;
use LaravelQuiz\Models\AnswerOption;
use LaravelQuiz\Models\Helpers\HasAnswerOptions;

/**
 * Question with not in scope of quiz but could contain answers.
 *
 * @property-read Collection|AnswerOption[] $correctAnswerOptions Correct answer options on this question
 */
class QuestionWithAnswers extends Question implements HasAnswerOptionsContract
{
    use HasAnswerOptions;

    public function newQuery()
    {
        return parent::newQuery()->where(static::TYPE, '=', QuestionTypes::WITH_ANSWERS);
    }

    /**
     * Returns correct answer options for this question.
     *
     * @return mixed
     */
    public function correctAnswerOptions(): HasMany
    {
        return $this->answerOptions()->where(AnswerOption::IS_CORRECT, '=', true);
    }

    /**
     * {@inheritDoc}
     */
    public function isCouldBeAnswered(CanAnswerQuestions $user): bool
    {
        return true;
    }
}
