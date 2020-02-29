<?php

namespace Saritasa\LaravelQuiz\Contracts;

use Saritasa\LaravelQuiz\Exceptions\LaravelQuizException;

/**
 * Contract to handle quiz process. Guarantees valid quiz workflow in application.
 */
interface IQuizWorkflowService
{
    /**
     * Starts quiz for given user.
     *
     * @param IQuiz $quiz Quiz to start
     * @param CanAnswerQuestions $position User for whom need to start quiz
     *
     * @return IUserQuiz
     *
     * @throws LaravelQuizException
     */
    public function start(IQuiz $quiz, CanAnswerQuestions $position): IUserQuiz;

    /**
     * Finish quiz.
     *
     * @param IUserQuiz $userQuiz Quiz of position that need to finish
     *
     * @throws LaravelQuizException
     */
    public function finish(IUserQuiz $userQuiz): void;
}
