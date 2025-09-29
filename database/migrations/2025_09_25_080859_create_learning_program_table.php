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

            $table->string('forcem');
            $table->float('hours');
            $table->string('type');
            $table->string('modality');
            $table->text('info');
            $table->string('assistent');
            $table->date('finish_date');
            $table->text('certification');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('center_id');

            $table->timestamps('start_date');
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
