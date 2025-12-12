<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name')->nullable();
            $table->string('class_section')->nullable();
            $table->string('exam_title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->text('questions')->nullable(); // JSON format for questions
            $table->text('options')->nullable(); // JSON format for options
            $table->text('correct_answer')->nullable(); // JSON format for correct answers
            $table->text('marks')->nullable(); // JSON format for marks per question
            $table->string('status')->default('active'); // active, inactive
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
        Schema::dropIfExists('exam');
    }
};

