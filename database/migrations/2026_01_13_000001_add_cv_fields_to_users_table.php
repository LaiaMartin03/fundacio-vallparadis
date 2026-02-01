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
        if (!Schema::hasColumn('users', 'cv_file_path') || !Schema::hasColumn('users', 'cv_original_filename')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'cv_file_path')) {
                    $table->string('cv_file_path')->nullable()->after('curriculum');
                }
                if (!Schema::hasColumn('users', 'cv_original_filename')) {
                    $table->string('cv_original_filename')->nullable()->after('cv_file_path');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop columns only if they exist to avoid errors when rolling back
        if (Schema::hasColumn('users', 'cv_file_path') || Schema::hasColumn('users', 'cv_original_filename')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'cv_file_path')) {
                    $table->dropColumn('cv_file_path');
                }
                if (Schema::hasColumn('users', 'cv_original_filename')) {
                    $table->dropColumn('cv_original_filename');
                }
            });
        }
    }
};
