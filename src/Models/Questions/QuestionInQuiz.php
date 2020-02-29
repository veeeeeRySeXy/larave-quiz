<?php

namespace Saritasa\LaravelQuiz\Models\Questions;

use Saritasa\LaravelQuiz\Enums\QuestionTypes;
use Saritasa\LaravelQuiz\Contracts\PartOfQuiz as PartOfQuizContract;
use Saritasa\LaravelQuiz\Models\Helpers\PartOfQuiz;

class QuestionInQuiz extends Question implements PartOfQuizContract
{
    use PartOfQuiz;

    /**
     * {@inheritDoc}
     */
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where(static::TYPE, '=', QuestionTypes::IN_QUIZ);
    }
}
