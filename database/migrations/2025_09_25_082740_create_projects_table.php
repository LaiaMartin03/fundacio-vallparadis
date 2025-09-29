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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('responsible');
            $table->text('description');
            $table->text('observations');
            $table->text('attached_docs');
            $table->unsignedBigInteger('center_id');

            $table->timestamps('start_date');

            //FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
