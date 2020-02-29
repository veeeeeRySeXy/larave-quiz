<?php

namespace Saritasa\LaravelQuiz\Models\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Saritasa\LaravelQuiz\Exceptions\LaravelQuizException;
use Saritasa\LaravelQuiz\Models\AnswerOption;
use Saritasa\LaravelQuiz\Models\UserAnswer;

/**
 * Helper for questions with has answers.
 *
 * @property-read Collection|AnswerOption[] $answerOptions Available answer options on this question
 * @property-read Collection|AnswerOption[] $correctAnswerOptions Correct answer options on this question
 *
 * @mixin Model
 */
trait HasAnswerOptions
{
    /**
     * {@inheritDoc}
     */
    public function getAnswerOptions(): Collection
    {
        return $this->answerOptions;
    }

    /**
     * Returns all answer options on this question.
     *
     * @return HasMany
     */
    public function answerOptions(): HasMany
    {
        return $this->hasMany(AnswerOption::class);
    }

    /**
     * Returns all answer options on this question.
     *
     * @return HasMany
     */
    public function correctAnswerOptions(): HasMany
    {
        return $this->hasMany(AnswerOption::class)->where(AnswerOption::IS_CORRECT, '=', true);
    }

    /**
     * Checks whether user answers for question are correct or not.
     *
     * @param Collection|UserAnswer[] $answers Answers options to check
     *
     * @return boolean
     *
     * @throws LaravelQuizException
     */
    public function isAnswersCorrect(Collection $answers): bool
    {
        if ($answers->count() === 0) {
            return false;
        }

        if ($answers->contains('question_id', '<>', $this->id)) {
            throw new LaravelQuizException();
        }

        $correctAnswerOptionIds = $this->correctAnswerOptions->pluck(AnswerOption::ID);
        $userAnsweredOptionIds = $answers->pluck('question_id');

        return $correctAnswerOptionIds->diff($userAnsweredOptionIds)->isEmpty();
    }
}
