<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manteniments', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['manteniment', 'seguiment'])->default('manteniment');
            $table->date('data'); // fecha de apertura o de seguimiento
            $table->unsignedBigInteger('responsable_id'); // usuario responsable/profesional
            $table->text('descripcio');
            $table->json('docs_adjunts')->nullable(); // para archivos adjuntos
            $table->timestamps();

            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manteniments');
    }
};
