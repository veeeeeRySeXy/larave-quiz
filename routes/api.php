<?php

use Illuminate\Routing\Router;
use Saritasa\LaravelQuiz\Http\Controllers\QuestionsApiController;
use Saritasa\LaravelQuiz\Http\Controllers\QuizApiController;

/**
 * Api router instance.
 *
 * @var Router $api
 */
$api = app(Router::class);

$api->post('questions/{question}/submitAnswer', QuestionsApiController::class . '@submitAnswer');
$api->post('quizzes/{quiz}/start', QuizApiController::class . '@start');
$api->post('quizzes/{quiz}/finish', QuizApiController::class . '@finish');
$api->get('quizzes/{quiz}/questions', QuizApiController::class . '@questions');
