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
        Schema::create('learning_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->enum('forcem', ['Horta', 'La Pineda', 'Ametlla', 'M.Betriu', 'T. de llops', 'Mas i Dalmau', 'Mora la Nova', 'Tamariu', 'Tursia', 'Cambrils Suite','Poblenou'])->default('Horta');;
            $table->float('hours')->nullable();
            $table->enum('type', ['Formació Interna', 'Formació Externa', 'Formació Salut laboral','Jorn/Taller/Seminari/Congrès'])->default('Formació Interna');
            $table->enum('modality', ['Presencial', 'On Line', 'Mixte'])->default('Presencial');;
            $table->text('info')->nullable();
            $table->unsignedBigInteger('assistent')->nullable();
            $table->date('finish_date')->nullable();
            $table->enum('certificate', ['Entregat', 'Pendent'])->default('Pendent');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //FK
            $table->foreign('center_id')->references('id')->on('center')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assistent')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_program');
    }
};
