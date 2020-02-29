<?php

namespace Saritasa\LaravelQuiz\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * After training quiz details.
 */
interface IUserQuiz
{
    /**
     * Returns this quiz identifier.
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Shows whether this quiz is valid and could be taken.
     *
     * @return boolean
     */
    public function isValid(): bool;

    /**
     * Returns quiz in scope of which this specific user's quiz info exists.
     *
     * @return IQuiz
     */
    public function getQuiz(): IQuiz;

    /**
     * Returns time when quiz was started by user.
     *
     * @return Carbon|null
     */
    public function getStartedAt(): ?Carbon;

    /**
     * Finishes this quiz if it possible.
     */
    public function finish(): void;

    /**
     * Returns questions with a sign of answer.
     *
     * @return Collection|HasAnswerOptions[]
     */
    public function getQuestions(): Collection;

    /**
     * Returns all answers in scope of this quiz.
     *
     * @return Collection
     */
    public function getAnswers(): Collection;
}
