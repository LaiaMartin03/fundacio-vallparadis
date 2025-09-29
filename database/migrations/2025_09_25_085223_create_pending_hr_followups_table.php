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
        Schema::create('pending_hr_followups', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->text('description');
            $table->text('attached_docs');
            $table->unsignedBigInteger('pending_hr_id');
            $table->unsignedBigInteger('professonal_user_id');

            $table->timestamps();

            //FK
            $table->foreign('pending_hr_id')->references('id')->on('pending_hr_issues')->onDelete('cascade');
            $table->foreign('professional_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_hr_followups');
    }
};
