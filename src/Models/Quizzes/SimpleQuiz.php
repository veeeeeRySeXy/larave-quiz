<?php

namespace LaravelQuiz\Models\Containers;

use App\Models\Enums\QuizTypes;

class SimpleQuiz extends Quiz
{
    public function newQuery()
    {
        return parent::newQuery()->where(static::TYPE, '=', QuizTypes::SIMPLE);
    }
}
