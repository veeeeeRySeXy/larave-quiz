<?php

namespace Saritasa\LaravelQuiz\Http\Controllers;

use Dingo\Api\Http\Response;
use Saritasa\LaravelQuiz\Contracts\IQuizWorkflowService;
use Saritasa\LaravelQuiz\Exceptions\LaravelQuizException;
use Saritasa\LaravelQuiz\Http\Transformers\QuestionTransformer;
use Saritasa\LaravelQuiz\Models\Quizzes\Quiz;
use Saritasa\LaravelQuiz\Services\QuizWorkflowService;
use Saritasa\LaravelControllers\Api\BaseApiController;

class QuizApiController extends BaseApiController
{
    /**
     * Quiz workflow service.
     *
     * @var QuizWorkflowService
     */
    protected $quizWorkflowService;

    /**
     * QuizApiController constructor.
     *
     * @param IQuizWorkflowService $quizWorkflowService Quiz workflow service
     */
    public function __construct(IQuizWorkflowService $quizWorkflowService)
    {
        parent::__construct();

        $this->quizWorkflowService = $quizWorkflowService;
    }

    /**
     * Starts given quiz for authorized user.
     *
     * @param Quiz $quiz Quiz to start
     *
     * @return Response
     *
     * @throws LaravelQuizException
     */
    public function start(Quiz $quiz): Response
    {
        $this->quizWorkflowService->start($quiz, $this->user);

        return $this->response->noContent();
    }

    /**
     * Finishes given quiz for user.
     *
     * @param Quiz $quiz Quiz to finish
     *
     * @return Response
     *
     * @throws LaravelQuizException
     */
    public function finish(Quiz $quiz): Response
    {
        $userQuiz = $quiz->getQuizForUser($this->user);

        if (!$userQuiz) {
            $this->response->errorForbidden();
        }

        $this->quizWorkflowService->finish($userQuiz);

        return $this->response->noContent();
    }

    /**
     * Returns quiz questions.
     *
     * @param Quiz $quiz Quiz to get questions
     * @param QuestionTransformer $transformer Questions transformer
     *
     * @return Response
     */
    public function questions(Quiz $quiz, QuestionTransformer $transformer): Response
    {
        $userQuiz = $quiz->getQuizForUser($this->user);

        if (!$userQuiz) {
            $this->response->errorForbidden();
        }

        return $this->response->collection($quiz->getQuestions(), $transformer);
    }
}
