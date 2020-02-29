<?php

namespace Saritasa\LaravelQuiz\Models\Quizzes;

use Saritasa\LaravelQuiz\Enums\QuizTypes;

class SimpleQuiz extends Quiz
{
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where(static::TYPE, '=', QuizTypes::SIMPLE);
    }
}
