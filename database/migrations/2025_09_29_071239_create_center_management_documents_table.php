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
        Schema::create('center_management_documents', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->date('date');
            $table->text('description');
            $table->text('attached_docs');
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('professional_user_id');
            
            $table->timestamps();

            //FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('professional_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_management_documents');
    }
};
