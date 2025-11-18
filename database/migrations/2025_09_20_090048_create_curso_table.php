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
        Schema::create('curso', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->notNull(); 
            $table->string('forcem', 255)->notNull();
            $table->float('hours')->nullable();
            $table->enum('type', ['Formació Interna', 'Formació Externa', 'Formació Salut laboral','Jorn/Taller/Seminari/Congrès'])->default('Formació Interna');
            $table->enum('modality', ['Presencial', 'Online', 'Mixte'])->default('Presencial');
            $table->text('info')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso');
    }
};