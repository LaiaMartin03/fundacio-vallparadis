<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('learning_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id'); 
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('curso_id')->references('id')->on('curso')->onDelete('cascade');
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_program');
    }
};