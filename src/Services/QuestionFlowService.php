<?php

namespace Saritasa\LaravelQuiz\Services;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Saritasa\LaravelQuiz\Contracts\CanAnswerQuestions;
use Saritasa\LaravelQuiz\Contracts\IQuestion;
use Saritasa\LaravelQuiz\Contracts\IQuestionsFlowService;
use Saritasa\LaravelQuiz\Events\QuestionAnsweredEvent;
use Saritasa\LaravelQuiz\Exceptions\LaravelQuizException;
use Saritasa\LaravelQuiz\Models\AnswerOption;
use Saritasa\LaravelQuiz\Models\Questions\QuestionWithAnswers;

class QuestionFlowService implements IQuestionsFlowService
{
    /**
     * Event dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Validation factory instance.
     *
     * @var Factory
     */
    protected $validationFactory;

    /**
     * QuestionFlowService constructor.
     *
     * @param Dispatcher $dispatcher Event dispatcher instance
     * @param Factory $validationFactory Validation factory instance
     */
    public function __construct(Dispatcher $dispatcher, Factory $validationFactory)
    {
        $this->dispatcher = $dispatcher;
        $this->validationFactory = $validationFactory;
    }

    /**
     * {@inheritDoc}
     *
     * @throws ValidationException
     */
    public function submitAnswer(IQuestion $question, CanAnswerQuestions $user, Collection $answers)
    {
        if (!$question->isCouldBeAnswered($user)) {
            throw new LaravelQuizException();
        }

        if ($question instanceof QuestionWithAnswers) {
            $this->validateAnswers($question, $answers);
        }

        $user->addAnswers($question, $answers);


        $this->dispatcher->dispatch(new QuestionAnsweredEvent($question, $user));

        // TODO: Вернуть результат
    }

    /**
     * Validates that given answer correct answer on given question.
     *
     * @param QuestionWithAnswers $question Question to check given answer on
     * @param Collection $answers Answer to validate
     *
     * @throws ValidationException
     */
    protected function validateAnswers(QuestionWithAnswers $question, Collection $answers): void
    {
        $validator = $this->validationFactory->make(['answers' => $answers->toArray()], [
            'answers.*' => [
                'required',
                Rule::exists('answer_options', AnswerOption::VALUE)
                    ->where(AnswerOption::QUESTION_ID, $question->getId()),
            ]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
