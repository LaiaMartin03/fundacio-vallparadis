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
        if (!Schema::hasColumn('users', 'profile_photo_path') || !Schema::hasColumn('users', 'profile_photo_original_filename')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'profile_photo_path')) {
                    $table->string('profile_photo_path')->nullable()->after('cv_original_filename');
                }
                if (!Schema::hasColumn('users', 'profile_photo_original_filename')) {
                    $table->string('profile_photo_original_filename')->nullable()->after('profile_photo_path');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'profile_photo_path') || Schema::hasColumn('users', 'profile_photo_original_filename')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'profile_photo_path')) {
                    $table->dropColumn('profile_photo_path');
                }
                if (Schema::hasColumn('users', 'profile_photo_original_filename')) {
                    $table->dropColumn('profile_photo_original_filename');
                }
            });
        }
    }
};
