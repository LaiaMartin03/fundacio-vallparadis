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
            $table->text('attached_docs')->nullable();

            $table->timestamps();
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
