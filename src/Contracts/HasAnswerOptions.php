<?php

namespace LaravelQuiz\Contracts;

use Illuminate\Support\Collection;

interface HasAnswerOptions
{
    /**
     * Returns all available answer options.
     *
     * @return Collection|IAnswerOption[]
     */
    public function getAnswerOptions(): Collection;

    /**
     * Checks whether give answers by user is correct on this question or not.
     *
     * @param Collection|string[] $answers Answer to check
     *
     * @return boolean
     */
    public function isAnswersCorrect(Collection $answers): bool;
}
