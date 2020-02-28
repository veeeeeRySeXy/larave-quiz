<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('user_id');
            $table->boolean('is_completed');
            $table->timestamp('started_at')->nullable();
            $table->unsignedInteger('time_spent')->nullable();
            $table->smallInteger('score')->nullable();
            $table->timestamp('valid_until')->nullable();

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
        Schema::dropIfExists('user_quizzes');
    }
}
