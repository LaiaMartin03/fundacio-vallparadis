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

            $table->string('affected_professional');
            $table->text('description');
            $table->text('attached_docs');
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('assigned_to');

            $table->timestamps('open_date');
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
