<?php

namespace Saritasa\LaravelQuiz\Models\Questions;

use Saritasa\LaravelQuiz\Enums\QuestionTypes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Saritasa\LaravelQuiz\Contracts\HasAnswerOptions as HasAnswerOptionsContract;
use Saritasa\LaravelQuiz\Models\AnswerOption;
use Saritasa\LaravelQuiz\Models\Helpers\HasAnswerOptions;

/**
 * Question with not in scope of quiz but could contain answers.
 *
 * @property-read Collection|AnswerOption[] $correctAnswerOptions Correct answer options on this question
 */
class QuestionWithAnswers extends Question implements HasAnswerOptionsContract
{
    use HasAnswerOptions;

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where(static::TYPE, '=', QuestionTypes::WITH_ANSWERS);
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
}
