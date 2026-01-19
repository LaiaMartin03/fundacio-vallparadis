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
        Schema::create('hr_followups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_id');
            $table->date('date');
            $table->string('topic')->nullable();
            $table->text('description');
            $table->string('attached_docs')->nullable();
            $table->unsignedBigInteger('registrant_id')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('hr_id')->references('id')->on('pending_hr_issues')->onDelete('cascade');
            $table->foreign('registrant_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_followups');
    }
};