<?php

namespace LaravelQuiz\Contracts;

interface IQuestion
{
    /**
     * Returns question identifier.
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Returns question title.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Shows whether question could be answered or not.
     *
     * @param CanAnswerQuestions $user User to check could be question answered for him or not
     *
     * @return boolean
     */
    public function isCouldBeAnswered(CanAnswerQuestions $user): bool;
}
