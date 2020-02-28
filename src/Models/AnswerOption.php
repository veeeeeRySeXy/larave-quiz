<?php

namespace LaravelQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelQuiz\Contracts\IAnswerOption;

/**
 * Class AnswerOption.
 *
 * @property int $id
 * @property int $question_id
 * @property string $value
 * @property bool $is_correct
 *
 * @property-read Question $question
 */
class AnswerOption extends Model implements IAnswerOption
{
    use SoftDeletes;

    public const ID = 'id';
    public const QUESTION_ID = 'question_id';
    public const VALUE = 'value';
    public const IS_CORRECT = 'is_correct';

    protected $casts = [
        self::QUESTION_ID => 'int',
        self::IS_CORRECT => 'bool',
    ];

    protected $fillable = [
        self::QUESTION_ID,
        self::VALUE,
        self::IS_CORRECT,
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
