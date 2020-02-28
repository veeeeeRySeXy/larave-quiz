<?php

namespace LaravelQuiz\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use LaravelQuiz\Contracts\IQuestion;
use LaravelQuiz\Contracts\IQuiz;
use LaravelQuiz\Contracts\IUserQuiz;

/**
 * Base user quiz information.
 *
 * @property integer $id This user quiz identifier
 * @property integer $user_id Trainee user identifier
 * @property integer $quiz_id Quiz identifier
 * @property Carbon|null $started_at When quiz of this training was started
 * @property Carbon|null $completed_at When quiz of this training was completed
 * @property Carbon|null $valid_until Date to which this quiz is could be completed
 *
 * @property-read Collection|IQuestion[] $questions All questions of this quiz
 * @property-read Collection|AnswerOption[] $answerOptions All chosen options in scope of this quiz
 * @property-read IQuiz $quiz Position of user in scope of which he finished training
 */
class UserQuiz extends Model implements IUserQuiz
{
    use SoftDeletes;
    use HasTimestamps;

    public const USER_ID = 'user_id';
    public const QUIZ_ID = 'quiz_id';
    public const STARTED_AT = 'started_at';

    protected $dates = [
        self::STARTED_AT,
    ];

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
    public function isValid(): bool
    {
        return !$this->completed_at;
    }

    /**
     * {@inheritDoc}
     */
    public function getQuiz(): IQuiz
    {
        return $this->quiz;
    }

    /**
     * {@inheritDoc}
     */
    public function finish(): void
    {
        $this->completed_at =  Carbon::now();
        $this->save();
    }

    /**
     * {@inheritDoc}
     */
    public function getQuestions(): Collection
    {
        return $this->quiz->getQuestions();
    }

    /**
     * {@inheritDoc}
     */
    public function getAnswers(): Collection
    {
        return $this->answerOptions;
    }

    /**
     * Returns time when quiz was started.
     *
     * @return Carbon|null
     */
    public function getStartedAt(): ?Carbon
    {
        return $this->started_at;
    }

    /**
     * Returns user relation of thiq user quiz.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Config::get('laravel_quiz.user'));
    }
}
