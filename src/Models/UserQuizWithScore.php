<?php

namespace LaravelQuiz\Models;

use LaravelQuiz\Contracts\HasScore;

/**
 * User quiz information which could also be scored.
 *
 * @property-read float $score Score of this user quiz
 */
class UserQuizWithScore extends UserQuiz implements HasScore
{
    /**
     * {@inheritDoc}
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * {@inheritDoc}
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
        $this->save();
    }
}
