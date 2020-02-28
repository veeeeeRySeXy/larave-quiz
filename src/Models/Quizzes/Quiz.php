<?php

namespace LaravelQuiz\Models\Containers;

use App\Models\Enums\QuizTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use LaravelQuiz\Contracts\CanAnswerQuestions;
use LaravelQuiz\Contracts\HasAnswerOptions;
use LaravelQuiz\Contracts\IQuiz;
use LaravelQuiz\Contracts\IUserQuiz;
use LaravelQuiz\Models\UserQuiz;
use SRLabs\EloquentSTI\SingleTableInheritanceTrait;

/**
 * Class Container
 *
 * @property-read Collection $userQuizzes User quizzes in scope of this quiz
 * @property-read Collection $questions Questions in scope of this quiz
 */
abstract class Quiz extends Model implements IQuiz
{
    use SingleTableInheritanceTrait;

    public const TYPE = 'type';

    protected $morphClass = Quiz::class;

    protected $discriminatorColumn = self::TYPE;

    protected $inheritanceMap = [
        QuizTypes::SIMPLE => SimpleQuiz::class,
        QuizTypes::WITH_SCORES => Quiz::class,
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
        return $this->questions->whereInstanceOf(HasAnswerOptions::class);
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
        return $this->hasMany(UserQuiz::class);
    }
}
