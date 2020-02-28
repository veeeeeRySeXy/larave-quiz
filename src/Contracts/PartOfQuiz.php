<?php

namespace LaravelQuiz\Contracts;

interface PartOfQuiz extends IQuestion
{
    /**
     * Returns quiz in scope of which this question exists.
     *
     * @return IQuiz
     */
    public function getQuiz(): IQuiz;
}
