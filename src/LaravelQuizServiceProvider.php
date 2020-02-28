<?php

namespace LaravelQuiz;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use LaravelQuiz\Contracts\IQuestionsFlowService;
use LaravelQuiz\Contracts\IQuizScoreService;
use LaravelQuiz\Contracts\IQuizWorkflowService;
use LaravelQuiz\Services\QuestionFlowService;
use LaravelQuiz\Services\QuizScoreService;
use LaravelQuiz\Services\QuizWorkflowService;

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
                __DIR__ . '/../config/health_check.php' =>
                    $this->app->make('path.config') . DIRECTORY_SEPARATOR . 'health_check.php',
            ],
            'health_check'
        );
        $this->mergeConfigFrom(__DIR__ . '/../config/health_check.php', 'health_check');
        $this->loadRoutesFrom(__DIR__. '/../routes/api.php');
    }
}
