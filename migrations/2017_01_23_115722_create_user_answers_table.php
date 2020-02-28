<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('user_quiz_id');

            $table->foreign(['answer_options_id'])->on('answer_options')->references('id');
            $table->foreign(['user_quiz_id'])->on('user_quizzes')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
}
