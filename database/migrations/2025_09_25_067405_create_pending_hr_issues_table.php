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
        Schema::create('pending_hr_issues', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('affected_professional');
            $table->text('description');
            $table->text('attached_docs')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('derivated_to')->nullable();
 
            $table->timestamps();

            //FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('affected_professional')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('derivated_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_hr_issues');
    }
};
