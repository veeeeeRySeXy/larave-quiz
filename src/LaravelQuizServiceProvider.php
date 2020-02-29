<?php

namespace Saritasa\LaravelQuiz;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Saritasa\LaravelQuiz\Contracts\IQuestionsFlowService;
use Saritasa\LaravelQuiz\Contracts\IQuizScoreService;
use Saritasa\LaravelQuiz\Contracts\IQuizWorkflowService;
use Saritasa\LaravelQuiz\Services\QuestionFlowService;
use Saritasa\LaravelQuiz\Services\QuizScoreService;
use Saritasa\LaravelQuiz\Services\QuizWorkflowService;

class LaravelQuizServiceProvider extends ServiceProvider
{
    /**
     * Register package implementation in DI container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IQuizWorkflowService::class, QuizWorkflowService::class);
        $this->app->bind(IQuestionsFlowService::class, QuestionFlowService::class);
        $this->app->bind(IQuizScoreService::class, QuizScoreService::class);
    }

    /**
     * Make package settings needed to correct work.
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../config/quiz.php' =>
                    $this->app->make('path.config') . DIRECTORY_SEPARATOR . 'quiz.php',
            ],
            'quiz'
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/quiz.php', 'quiz');
        $this->loadRoutesFrom(__DIR__. '/../routes/api.php');
    }
}
