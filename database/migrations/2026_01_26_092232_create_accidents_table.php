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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type'); // sense_baixa, amb_baixa, seguiment_baixes
            $table->string('context')->nullable();
            $table->text('description')->nullable();
            $table->integer('durada')->nullable(); // solo para amb_baixa
            $table->foreignId('professional_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('registrant_user_id')->constrained('users')->onDelete('cascade');
            $table->string('fitxa_file_path')->nullable(); // para la fitxa
            $table->string('fitxa_original_filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
