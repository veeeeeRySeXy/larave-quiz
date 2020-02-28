<?php

namespace LaravelQuiz\Services;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Collection;
use LaravelQuiz\Contracts\CanAnswerQuestions;
use LaravelQuiz\Contracts\IQuestion;
use LaravelQuiz\Contracts\IQuestionsFlowService;
use LaravelQuiz\Events\QuestionAnsweredEvent;
use LaravelQuiz\Exceptions\LaravelQuizException;

class QuestionFlowService implements IQuestionsFlowService
{
    /**
     * Event dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * QuestionFlowService constructor.
     *
     * @param Dispatcher $dispatcher Event dispatcher instance
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     */
    public function submitAnswer(IQuestion $question, CanAnswerQuestions $user, Collection $answers)
    {
        if (!$question->isCouldBeAnswered($user)) {
            throw new LaravelQuizException();
        }

        foreach ($answers as $answer) {
            $user->addAnswer($question, $answer);
        }

        $this->dispatcher->dispatch(new QuestionAnsweredEvent($question, $user));

        // TODO: Вернуть результат
    }
}
