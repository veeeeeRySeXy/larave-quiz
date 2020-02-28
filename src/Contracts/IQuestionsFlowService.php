<?php

namespace LaravelQuiz\Contracts;

use Illuminate\Support\Collection;
use LaravelQuiz\Exceptions\LaravelQuizException;

interface IQuestionsFlowService
{
    /**
     * Submits answer on question by given user.
     *
     * @param IQuestion $question Question to submit answer
     * @param CanAnswerQuestions $user User
     * @param Collection|string[] $answers Answers on this question to submit
     *
     * @return mixed
     *
     * @throws LaravelQuizException
     */
    public function submitAnswer(IQuestion $question, CanAnswerQuestions $user, Collection $answers);
}
