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
        Schema::create('evaluation_form', function (Blueprint $table) {
            $table->id();

            $table->float('total');
            $table->unsignedBigInteger('center_control_id');
            $table->unsignedBigInteger('evaluator_user_id');
            $table->timestamps();

            //FK
            $table->foreign('center_control_id')->references('id')->on('center_control')->onDelete('cascade');
            $table->foreign('evaluator_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_form');
    }
};
