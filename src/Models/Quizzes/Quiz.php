<?php

namespace Saritasa\LaravelQuiz\Models\Quizzes;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Saritasa\LaravelQuiz\Enums\QuizTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Contracts\IQuiz;
use Saritasa\LaravelQuiz\Contracts\IUserQuiz;
use Saritasa\LaravelQuiz\Models\Questions\Question;
use Saritasa\LaravelQuiz\Models\UserQuiz;
use SRLabs\EloquentSTI\SingleTableInheritanceTrait;

/**
 * Class Container
 *
 * @property-read Collection $userQuizzes User quizzes in scope of this quiz
 * @property-read Collection $questions Questions in scope of this quiz
 */
class Quiz extends Model implements IQuiz
{
    use HasTimestamps;
    use SingleTableInheritanceTrait;
    use SoftDeletes;

    public const TYPE = 'type';
    public const NAME = 'name';

    protected $morphClass = Quiz::class;

    protected $discriminatorColumn = self::TYPE;

    protected $table = 'quizzes';

    protected $inheritanceMap = [
        QuizTypes::SIMPLE => SimpleQuiz::class,
        QuizTypes::WITH_SCORES => Quiz::class,
    ];

    protected $fillable = [
        self::NAME,
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
    public function isCouldBeStarted(CanAnswerQuestions $user): bool
    {
        $userQuiz = $this->getQuizForUser($user);

        if (!$userQuiz) {
            return true;
        }

        return !$userQuiz->getStartedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * {@inheritDoc}
     */
    public function getQuizForUser(CanAnswerQuestions $user): ?IUserQuiz
    {
        return $this->userQuizzes->firstWhere(UserQuiz::USER_ID, '=', $user->getId());
    }

    /**
     * Returns Eloquent relations with user quizzes.
     *
     * @return HasMany
     */
    public function userQuizzes(): HasMany
    {
        return $this->hasMany(UserQuiz::class, UserQuiz::QUIZ_ID);
    }

    /**
     * Returns Eloquent relations with questions.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}
