<?php

namespace LaravelQuiz\Events;

use LaravelQuiz\Contracts\IUserQuiz;

class QuizFinishedEvent
{
    /**
     * User quiz which was finished.
     *
     * @var IUserQuiz
     */
    protected $userQuiz;

    /**
     * QuizFinishedEvent constructor.
     *
     * @param IUserQuiz $userQuiz User quiz which was finished
     */
    public function __construct(IUserQuiz $userQuiz)
    {
        $this->userQuiz = $userQuiz;
    }

    /**
     * Returns user quiz which was finished.
     *
     * @return IUserQuiz
     */
    public function getUserQuiz(): IUserQuiz
    {
        return $this->userQuiz;
    }
}
