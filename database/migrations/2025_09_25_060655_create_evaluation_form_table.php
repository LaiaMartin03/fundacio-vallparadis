<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // añadir columnas faltantes a evaluation_form
        Schema::table('evaluation_form', function (Blueprint $table) {
            // añade quien és el professional avaluat
            if (! Schema::hasColumn('evaluation_form', 'professional_id')) {
                $table->unsignedBigInteger('professional_id')->nullable()->after('id');
            }

            // columnes referenciades que faltaven
            if (! Schema::hasColumn('evaluation_form', 'center_control_id')) {
                $table->unsignedBigInteger('center_control_id')->nullable()->after('professional_id');
            }
            if (! Schema::hasColumn('evaluation_form', 'evaluator_user_id')) {
                $table->unsignedBigInteger('evaluator_user_id')->nullable()->after('center_control_id');
            }

            // camp d'observacions
            if (! Schema::hasColumn('evaluation_form', 'observations')) {
                $table->text('observations')->nullable()->after('total');
            }

            // crea les foreign keys (si les taules referenciades existeixen)
            // ajusta noms de taules si a la teva DB són diferents (users, center_control, etc.)
            $table->foreign('professional_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('center_control_id')->references('id')->on('center_control')->onDelete('set null');
            $table->foreign('evaluator_user_id')->references('id')->on('users')->onDelete('set null');
        });

        // crea taula per a les respostes detallades (pregunta -> puntuació)
        Schema::create('evaluation_form_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_form_id');
            $table->string('question_key'); // p.ex. q1, q2...
            $table->tinyInteger('score'); // 1..4
            $table->timestamps();

            $table->foreign('evaluation_form_id')->references('id')->on('evaluation_form')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_form_answers');

        Schema::table('evaluation_form', function (Blueprint $table) {
            // eliminar FK abans de les columnes
            if (Schema::hasColumn('evaluation_form', 'professional_id')) {
                $table->dropForeign(['professional_id']);
                $table->dropColumn('professional_id');
            }
            if (Schema::hasColumn('evaluation_form', 'center_control_id')) {
                $table->dropForeign(['center_control_id']);
                $table->dropColumn('center_control_id');
            }
            if (Schema::hasColumn('evaluation_form', 'evaluator_user_id')) {
                $table->dropForeign(['evaluator_user_id']);
                $table->dropColumn('evaluator_user_id');
            }
            if (Schema::hasColumn('evaluation_form', 'observations')) {
                $table->dropColumn('observations');
            }
        });
    }
};
