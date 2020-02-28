<?php

namespace LaravelQuiz\Models\Questions;

use App\Models\Enums\QuestionTypes;
use LaravelQuiz\Contracts\CanAnswerQuestions;

/**
 * Question for training quiz in scope of module.
 */
class SimpleQuestion extends Question
{
    public function newQuery()
    {
        return parent::newQuery()->where(static::TYPE, '=', QuestionTypes::SIMPLE);
    }

    public function isCouldBeAnswered(CanAnswerQuestions $user): bool
    {
        return true;
    }
}
