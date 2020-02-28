<?php

use Illuminate\Routing\Router;
use LaravelQuiz\Http\Controllers\QuestionsApiController;
use LaravelQuiz\Http\Controllers\QuizApiController;

/**
 * Api router instance.
 *
 * @var Router $api
 */
$api = app(Router::class);

$api->post('questions/{question}/submitAnswer', QuestionsApiController::class . '@submitAnswer');
$api->post('quizzes/{quiz}/start', QuizApiController::class . '@start');
$api->post('quizzes/{quiz}/finish', QuizApiController::class . '@finish');
