<?php

namespace LaravelQuiz\Services;

use Illuminate\Contracts\Events\Dispatcher;
use LaravelQuiz\Contracts\CanAnswerQuestions;
use LaravelQuiz\Contracts\IQuiz;
use LaravelQuiz\Contracts\IQuizWorkflowService;
use LaravelQuiz\Contracts\IUserQuiz;
use LaravelQuiz\Events\QuizFinishedEvent;
use LaravelQuiz\Events\QuizStartedEvent;
use LaravelQuiz\Exceptions\LaravelQuizException;

/**
 * Service to handle quiz process.
 */
class QuizWorkflowService implements IQuizWorkflowService
{
    /**
     * Event dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * QuizWorkflowService constructor.
     *
     * @param Dispatcher $dispatcher Event dispatcher instance
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function start(IQuiz $quiz, CanAnswerQuestions $user): IUserQuiz
    {
        if (!$quiz->isCouldBeStarted($user)) {
            throw new LaravelQuizException();
        }

        $userQuiz = $user->startQuiz($quiz);

        $this->dispatcher->dispatch(new QuizStartedEvent($userQuiz));

        return $userQuiz;
    }

    /**
     * {@inheritdoc}
     */
    public function finish(IUserQuiz $userQuiz): void
    {
        if (!$userQuiz->isValid()) {
            throw new LaravelQuizException();
        }

        $userQuiz->finish();

        $this->dispatcher->dispatch(new QuizFinishedEvent($userQuiz));
    }
}
