<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id')->nullable()->default(null);
            $table->string('question');
            $table->text('explanation')->nullable();
            $table->enum('type', ['simple', 'withAnswers', 'inQuiz', 'withAnswersInQuiz']);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign(['quiz_id'])->on('quizzes')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}
