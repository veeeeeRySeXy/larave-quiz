<?php

namespace App\Models\Enums;

use Saritasa\Enum;

class QuizTypes extends Enum
{
    public const SIMPLE = 'simple';
    public const WITH_SCORES = 'withScores';
}
