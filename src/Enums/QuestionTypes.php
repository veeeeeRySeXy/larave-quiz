<?php

namespace Saritasa\LaravelQuiz\Enums;

use Saritasa\Enum;

/**
 * Question Types.
 */
class QuestionTypes extends Enum
{
    public const SIMPLE = 'simple';

    public const WITH_ANSWERS = 'withAnswers';

    public const IN_QUIZ = 'inQuiz';

    public const WITH_ANSWERS_IN_QUIZ = 'withAnswersInQuiz';
}
