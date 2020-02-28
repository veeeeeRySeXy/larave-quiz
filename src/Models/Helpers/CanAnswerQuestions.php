<?php

namespace LaravelQuiz\Models\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelQuiz\Contracts\IQuestion;
use LaravelQuiz\Contracts\IQuiz;
use LaravelQuiz\Contracts\IUserQuiz;
use LaravelQuiz\Models\UserAnswer;
use LaravelQuiz\Models\UserQuiz;

/**
 * @mixin Model
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
    public function addAnswer(IQuestion $question, string $value): void
    {
        $this->userAnswers()->save(new UserAnswer([
            UserAnswer::VALUE => $value,
            UserAnswer::QUESTION_ID => $question->getId(),
        ]));
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
