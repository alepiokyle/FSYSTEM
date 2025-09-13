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
        Schema::create('teachers_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teachers_profile_id')->nullable()->constrained('teachers_profile')->onDelete('cascade');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->foreignId('user_role_id')->constrained('user_role')->onDelete('cascade');
            $table->boolean('is_active')->default(1)->comment('1=ACTIVATED, 0=DEACTIVATED');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_account');
    }
};
