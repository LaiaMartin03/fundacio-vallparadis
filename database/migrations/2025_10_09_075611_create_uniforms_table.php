<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uniforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('given_by_user_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('shirt_size')->nullable();
            $table->integer('pants_size')->nullable();
            $table->boolean('lab_coat')->default(0);
            $table->integer('shoe_size')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uniforms');
    }
};
