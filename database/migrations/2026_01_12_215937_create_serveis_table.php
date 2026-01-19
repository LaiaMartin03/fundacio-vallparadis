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
        Schema::create('serveis', function (Blueprint $table) {
            $table->id();
            $table->string('tipus');
            $table->string('name');
            $table->text('desc');
            $table->text('observacions')->nullable();

            $table->foreignId('internal_doc_id')
            ->nullable()
                ->constrained('internal_docs')
                ->onDelete('cascade');

            $table->foreignId('user_id')
            ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serveis');
    }
};
