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

            $table->date('title');  
            $table->text('descripcio');
            
            $table->foreignId('responsable_id')
                ->constrained('users')
                ->onDelete('cascade');
            
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
