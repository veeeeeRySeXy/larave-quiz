<?php

namespace Saritasa\LaravelQuiz\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Support\Collection;

class RequestWithAnswers extends FormRequest
{
    /**
     * Shows could be this request performed or not.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Returns validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'string'],
        ];
    }

    /**
     * Returns answers as collection from this request.
     *
     * @return Collection
     */
    public function getAnswers(): Collection
    {
        return collect($this->get('answers'));
    }
}
