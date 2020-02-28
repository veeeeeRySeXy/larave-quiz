<?php

namespace LaravelQuiz\Tests;

use Illuminate\Contracts\Events\Dispatcher;
use Mockery;
use PHPUnit\Framework\TestCase;

class QuestionFlowServiceTest extends TestCase
{
    protected $dispatcherMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->dispatcherMock = Mockery::mock(Dispatcher::class);
    }

    public function testSubmitAnswer(): void
    {
        // $question =
    }
}
