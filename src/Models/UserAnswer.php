<?php

namespace Saritasa\LaravelQuiz\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasTimestamps;

    public const ANSWER = 'answer';
    public const QUESTION_ID = 'question_id';

    protected $fillable = [
        self::ANSWER,
        self::QUESTION_ID,
    ];
}
