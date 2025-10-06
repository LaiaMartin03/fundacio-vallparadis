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
            $table->unsignedBigInteger('center_id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('responsible_professional')->nullable();
            $table->text('description')->nullable();
            $table->text('observations')->nullable();
            $table->string('type')->nullable();
            $table->integer('docs')->default(0);
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->timestamps();

            //  FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('responsible_professional')->references('id')->on('users')->onDelete('set null');
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

