<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            //Uniforms
            $table->integer('shirt_size')->nullable();
            $table->integer('pants_size')->nullable();
            $table->boolean('lab_coat')->default(0);
            $table->integer('shoe_size')->nullable();
            //Relaciones
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('given_by_user_id');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            //FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('given_by_user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
