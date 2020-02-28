<?php

namespace LaravelQuiz\Listeners;

use LaravelQuiz\Contracts\HasScore;
use LaravelQuiz\Contracts\IQuizScoreService;
use LaravelQuiz\Events\QuizFinishedEvent;

class CalculateQuizScoreEvent
{
    /**
     * Quiz score calculation service.
     *
     * @var IQuizScoreService
     */
    protected $quizScoreService;

    /**
     * CalculateQuizScoreEvent constructor.
     *
     * @param IQuizScoreService $quizScoreService Quiz score calculation service
     */
    public function __construct(IQuizScoreService $quizScoreService)
    {
        $this->quizScoreService = $quizScoreService;
    }

    /**
     * Handles the event.
     *
     * @param QuizFinishedEvent $event Event with finished quiz information
     *
     * @return void
     */
    public function handle(QuizFinishedEvent $event) : void
    {
        $userQuiz = $event->getUserQuiz();

        if (!$userQuiz instanceof HasScore) {
            return;
        }

        $userQuiz->setScore($this->quizScoreService->calculate($userQuiz));
    }
}
