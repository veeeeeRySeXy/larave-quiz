<?php

namespace Saritasa\LaravelQuiz\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Saritasa\LaravelQuiz\Contracts\IQuestion;

class QuestionTransformer extends TransformerAbstract
{
    /**
     * Returns questions appropriate data.
     *
     * @param IQuestion $question Question to transform
     *
     * @return array
     */
    public function transform(IQuestion $question): array
    {
        return [
            'id' => $question->getId(),
            'title' => $question->getTitle(),
        ];
    }
}
