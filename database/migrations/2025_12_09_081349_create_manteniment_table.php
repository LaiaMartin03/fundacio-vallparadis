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
        Schema::create('manteniment', function (Blueprint $table) {
            $table->id();

            $table->enum('tipo', ['manteniment', 'seguiment']);
            
            $table->date('data');  
            $table->text('descripcio');
            
            $table->string('responsable');
            
            $table->json('docs_adjunts')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manteniment');
    }
};
