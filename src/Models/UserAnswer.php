<?php

namespace LaravelQuiz\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasTimestamps;

    public const VALUE = 'value';
    public const QUESTION_ID = 'question_id';
}
