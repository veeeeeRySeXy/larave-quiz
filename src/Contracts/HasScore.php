<?php

namespace Saritasa\LaravelQuiz\Contracts;

interface HasScore extends IUserQuiz
{
    /**
     * Returns this user's quiz score.
     *
     * @return float
     */
    public function getScore(): float;

    /**
     * Sets user's quiz score.
     *
     * @param float $score Score to set
     *
     * @return void
     */
    public function setScore(float $score): void;
}
