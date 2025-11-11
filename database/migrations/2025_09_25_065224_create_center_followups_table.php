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
        Schema::create('center_followups', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->text('description');
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('professional_user_id');
            $table->unsignedBigInteger('registrant_user_id')->nullable();
            $table->enum('type', ['obert','restringit','origen','fi_vinculacio'])->default('obert');
            $table->string('topic')->nullable();
            $table->text('attached_docs')->nullable();

            $table->timestamps();

            // FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('professional_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('registrant_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_followups');
    }
};
