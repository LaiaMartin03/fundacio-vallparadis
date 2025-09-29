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
        Schema::create('center_control_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_control_id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->timestamp('date');
            $table->text('comment');
            $table->timestamps();

            // FK
            $table->foreign('center_control_id')->references('id')->on('center_control')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_control_comments');
    }
};
