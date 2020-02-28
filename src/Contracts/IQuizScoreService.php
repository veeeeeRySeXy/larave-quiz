<?php

namespace LaravelQuiz\Contracts;

/**
 * Contract for checks or calculates answers on quiz questions.
 */
interface IQuizScoreService
{
    /**
     * Calculates user's score for given user quiz.
     *
     * @param HasScore $userQuiz User quiz to calculate score
     *
     * @return float
     */
    public function calculate(HasScore $userQuiz): float;
}
