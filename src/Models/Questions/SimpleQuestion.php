<?php

namespace Saritasa\LaravelQuiz\Models\Questions;

use Saritasa\LaravelQuiz\Enums\QuestionTypes;

/**
 * Question for training quiz in scope of module.
 */
class SimpleQuestion extends Question
{
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where(static::TYPE, '=', QuestionTypes::SIMPLE);
    }
}
