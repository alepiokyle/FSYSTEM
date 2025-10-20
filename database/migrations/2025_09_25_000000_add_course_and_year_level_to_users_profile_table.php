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
        Schema::table('users_profile', function (Blueprint $table) {
            $table->string('course')->nullable()->after('gender');
            $table->string('year_level')->nullable()->after('course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_profile', function (Blueprint $table) {
            $table->dropColumn(['course', 'year_level']);
        });
    }
};
