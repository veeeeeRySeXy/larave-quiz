<?php

namespace Saritasa\LaravelQuiz\Models\Questions;

use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Enums\QuestionTypes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Saritasa\LaravelQuiz\Contracts\IQuestion;
use SRLabs\EloquentSTI\SingleTableInheritanceTrait;

/**
 * Question for training quiz in scope of module.
 *
 * @property int $id Identifier
 * @property string|null $question Question message
 * @property-read string $type Type of this question (multiple, single, etc)
 * @property string|null $explanation Explanation of correct answer
 */
class Question extends Eloquent implements IQuestion
{
    use HasTimestamps;
    use SingleTableInheritanceTrait;
    use SoftDeletes;

    public const ID = 'id';
    public const QUESTION = 'question';
    public const TYPE = 'type';
    public const EXPLANATION = 'explanation';

    protected $fillable = [
        self::QUESTION,
        self::EXPLANATION,
    ];

    protected $morphClass = Question::class;

    protected $discriminatorColumn = self::TYPE;

    protected $inheritanceMap = [
        QuestionTypes::SIMPLE => SimpleQuestion::class,
        QuestionTypes::WITH_ANSWERS => QuestionWithAnswers::class,
        QuestionTypes::IN_QUIZ => QuestionInQuiz::class,
        QuestionTypes::WITH_ANSWERS_IN_QUIZ => QuestionInQuizWithAnswers::class,
    ];

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {
        return $this->question;
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->getKey();
    }


    /**
     * {@inheritDoc}
     */
    public function isCouldBeAnswered(CanAnswerQuestions $user): bool
    {
        return $user->getAnswers($this)->isEmpty();
    }
}
