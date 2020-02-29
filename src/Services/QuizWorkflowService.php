<?php

namespace Saritasa\LaravelQuiz\Services;

use Illuminate\Contracts\Events\Dispatcher;
use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Contracts\IQuiz;
use Saritasa\LaravelQuiz\Contracts\IQuizWorkflowService;
use Saritasa\LaravelQuiz\Contracts\IUserQuiz;
use Saritasa\LaravelQuiz\Events\QuizFinishedEvent;
use Saritasa\LaravelQuiz\Events\QuizStartedEvent;
use Saritasa\LaravelQuiz\Exceptions\LaravelQuizException;

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
