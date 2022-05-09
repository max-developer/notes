<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('note_id');
            $table->foreign('note_id')->references('id')->on('notes')->cascadeOnDelete();
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_questions');
    }
}
