<?php

namespace LaravelQuiz\Models\Questions;

use App\Models\Enums\QuestionTypes;
use LaravelQuiz\Contracts\HasAnswerOptions as HasAnswerOptionsContract;
use LaravelQuiz\Contracts\PartOfQuiz as PartOfQuizContract;
use LaravelQuiz\Models\Helpers\HasAnswerOptions;
use LaravelQuiz\Models\Helpers\PartOfQuiz;

class QuestionInQuizWithAnswers extends Question implements HasAnswerOptionsContract, PartOfQuizContract
{
    use HasAnswerOptions;
    use PartOfQuiz;

    /**
     * {@inheritDoc}
     */
    public function newQuery()
    {
        return parent::newQuery()->where(static::TYPE, '=', QuestionTypes::WITH_ANSWERS_IN_QUIZ);
    }
}
