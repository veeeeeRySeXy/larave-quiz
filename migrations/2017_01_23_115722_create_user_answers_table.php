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
            $table->unsignedInteger('user_id');
            $table->string('answer');
            $table->timestamps();

            $table->foreign(['question_id'])->on('questions')->references('id');
            //$table->foreign(['user_quiz_id'])->on('user_quizzes')->references('id');
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
