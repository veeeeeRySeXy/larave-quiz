<?php

namespace Saritasa\LaravelQuiz\Models\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Saritasa\LaravelQuiz\Contracts\IQuestion;
use Saritasa\LaravelQuiz\Contracts\IQuiz;
use Saritasa\LaravelQuiz\Contracts\IUserQuiz;
use Saritasa\LaravelQuiz\Models\UserAnswer;
use Saritasa\LaravelQuiz\Models\UserQuiz;

/**
 * @mixin Model
 *
 * @property-read Collection $userAnswers User answers
 */
trait CanAnswerQuestions
{
    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function addAnswers(IQuestion $question, Collection $answers): void
    {
        $answers->each(function (string $answer) use ($question) {
            $this->userAnswers()->save(new UserAnswer([
                UserAnswer::ANSWER => $answer,
                UserAnswer::QUESTION_ID => $question->getId(),
            ]));
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getAnswers(IQuestion $question): Collection
    {
        return $this->userAnswers()->where(UserAnswer::QUESTION_ID, '=', $question->getId())->get();
    }

    /**
     * {@inheritDoc}
     */
    public function startQuiz(IQuiz $quiz): IUserQuiz
    {
        $userQuiz = $quiz->getQuizForUser($this) ?? new UserQuiz([UserQuiz::QUIZ_ID => $quiz->getId()]);
        $userQuiz->started_at = Carbon::now();

        $this->userQuizzes()->save($userQuiz);

        return $userQuiz;
    }

    /**
     * Returns user answers relation.
     *
     * @return HasMany
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }

    /**
     * Returns user quizzes relation.
     *
     * @return HasMany
     */
    public function userQuizzes(): HasMany
    {
        return $this->hasMany(UserQuiz::class);
    }
}
