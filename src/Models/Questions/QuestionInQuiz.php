<?php

namespace LaravelQuiz\Models\Questions;

use App\Models\Enums\QuestionTypes;
use LaravelQuiz\Contracts\PartOfQuiz as PartOfQuizContract;
use LaravelQuiz\Models\Helpers\PartOfQuiz;

class QuestionInQuiz extends Question implements PartOfQuizContract
{
    use PartOfQuiz;

    /**
     * {@inheritDoc}
     */
    public function newQuery()
    {
        return parent::newQuery()->where(static::TYPE, '=', QuestionTypes::IN_QUIZ);
    }
}
