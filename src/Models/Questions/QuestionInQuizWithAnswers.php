<?php

namespace Saritasa\LaravelQuiz\Models\Questions;

use Saritasa\LaravelQuiz\Enums\QuestionTypes;
use Saritasa\LaravelQuiz\Contracts\HasAnswerOptions as HasAnswerOptionsContract;
use Saritasa\LaravelQuiz\Contracts\PartOfQuiz as PartOfQuizContract;
use Saritasa\LaravelQuiz\Models\Helpers\HasAnswerOptions;
use Saritasa\LaravelQuiz\Models\Helpers\PartOfQuiz;

class QuestionInQuizWithAnswers extends Question implements HasAnswerOptionsContract, PartOfQuizContract
{
    use HasAnswerOptions;
    use PartOfQuiz;

    /**
     * {@inheritDoc}
     */
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where(static::TYPE, '=', QuestionTypes::WITH_ANSWERS_IN_QUIZ);
    }
}
