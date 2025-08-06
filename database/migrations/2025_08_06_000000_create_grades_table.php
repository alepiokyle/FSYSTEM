<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->decimal('prelim', 5, 2)->nullable();
            $table->decimal('midterm', 5, 2)->nullable();
            $table->decimal('semi_final', 5, 2)->nullable();
            $table->decimal('final', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->string('status')->default('pending');
            $table->string('semester');
            $table->string('school_year');
            $table->timestamps();
            
            $table->unique(['student_id', 'subject_id', 'semester', 'school_year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
