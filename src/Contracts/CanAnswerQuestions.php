<?php

namespace Saritasa\LaravelQuiz\Contracts;

use Illuminate\Support\Collection;

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
     * @param Collection|string[] $answers Answers to add
     *
     * @return void
     */
    public function addAnswers(IQuestion $question, Collection $answers): void;

    public function getAnswers(IQuestion $question): Collection;

    /**
     * Starts given quiz for this user if it possible.
     *
     * @param IQuiz $quiz Quiz to start
     *
     * @return IUserQuiz
     */
    public function startQuiz(IQuiz $quiz): IUserQuiz;
}
