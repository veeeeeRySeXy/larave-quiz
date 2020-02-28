<?php

namespace LaravelQuiz\Contracts;

interface CanAnswerQuestions
{
    /**
     * Returns user identifier.
     *
     * @return integer
     */
    public function getId(): int;

    /**
     * Adds answer on given question.
     *
     * @param IQuestion $question Question to add answer
     * @param string $value Answer value
     *
     * @return integer
     */
    public function addAnswer(IQuestion $question, string $value);

    /**
     * Starts given quiz for this user if it possible.
     *
     * @param IQuiz $quiz Quiz to start
     *
     * @return IUserQuiz
     */
    public function startQuiz(IQuiz $quiz): IUserQuiz;
}
