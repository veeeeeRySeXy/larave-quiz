<?php

namespace LaravelQuiz\Contracts;

use Illuminate\Support\Collection;

interface IQuiz
{
    /**
     * Returns identifier.
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Returns questions available in scope of this quiz.
     *
     * @return Collection
     */
    public function getQuestions(): Collection;

    /**
     * Shows whether this quiz could be started by given user.
     *
     * @param CanAnswerQuestions $user User to check availability of quiz
     *
     * @return boolean
     */
    public function isCouldBeStarted(CanAnswerQuestions $user): bool;

    /**
     * Returns specific quiz information for given user.
     *
     * @param CanAnswerQuestions $user User to get his quiz information
     *
     * @return IUserQuiz|null
     */
    public function getQuizForUser(CanAnswerQuestions $user): ?IUserQuiz;
}
