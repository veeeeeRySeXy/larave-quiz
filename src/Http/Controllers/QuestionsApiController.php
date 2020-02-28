<?php

namespace LaravelQuiz\Http\Controllers;

use Dingo\Api\Http\Response;
use LaravelQuiz\Contracts\IQuestionsFlowService;
use LaravelQuiz\Exceptions\LaravelQuizException;
use LaravelQuiz\Http\Requests\RequestWithAnswers;
use LaravelQuiz\Models\Questions\Question;
use Saritasa\LaravelControllers\Api\BaseApiController;

class QuestionsApiController extends BaseApiController
{
    /**
     * Questions flow service.
     *
     * @var IQuestionsFlowService
     */
    protected $questionsFlowService;

    /**
     * QuestionsApiController constructor.
     *
     * @param IQuestionsFlowService $questionsFlowService Questions flow service
     */
    public function __construct(IQuestionsFlowService $questionsFlowService)
    {
        parent::__construct();

        $this->questionsFlowService = $questionsFlowService;
    }

    /**
     * Submits answer on given question.
     *
     * @param Question $question Question to submit answer on
     * @param RequestWithAnswers $request Request with answer information
     *
     * @return Response
     *
     * @throws LaravelQuizException
     */
    public function submitAnswer(Question $question, RequestWithAnswers $request): Response
    {
        $this->questionsFlowService->submitAnswer($question, $this->user, $request->getAnswers());

        return $this->response->noContent();
    }
}
