<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id')->nullable();
            $table->unsignedBigInteger('center_control_id')->nullable();
            $table->unsignedBigInteger('evaluator_user_id')->nullable();
            $table->text('observations')->nullable();
            $table->integer('total')->default(0);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('professional_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('center_control_id')->references('id')->on('center_control')->onDelete('set null');
            $table->foreign('evaluator_user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('evaluation_form_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_form_id');
            $table->string('question_key'); 
            $table->tinyInteger('score');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('evaluation_form_id')->references('id')->on('evaluation_form')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_form_answers');
        Schema::dropIfExists('evaluation_form');
    }
};