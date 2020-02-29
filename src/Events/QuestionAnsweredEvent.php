<?php

namespace Saritasa\LaravelQuiz\Events;

use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Contracts\IQuestion;

class QuestionAnsweredEvent
{
    /**
     * Question which was answered.
     *
     * @var IQuestion
     */
    protected $question;

    /**
     * User answered on question.
     *
     * @var CanAnswerQuestions
     */
    protected $user;

    /**
     * QuestionAnsweredEvent constructor.
     *
     * @param IQuestion $question Question which was answered
     * @param CanAnswerQuestions $user User answered on question
     */
    public function __construct(IQuestion $question, CanAnswerQuestions $user)
    {
        $this->question = $question;
        $this->user = $user;
    }

    /**
     * Returns question.
     *
     * @return IQuestion
     */
    public function getQuestion(): IQuestion
    {
        return $this->question;
    }

    /**
     * Returns user.
     *
     * @return CanAnswerQuestions
     */
    public function getUser(): CanAnswerQuestions
    {
        return $this->user;
    }
}
