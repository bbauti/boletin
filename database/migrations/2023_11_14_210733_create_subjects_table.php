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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->foreignId('teacher_id')->constrained('users')->where('role', 'teacher');
            $table->foreignId('course_id')->constrained('courses');
            $table->time('monday_schedule')->nullable();
            $table->time('tuesday_schedule')->nullable();
            $table->time('wednesday_schedule')->nullable();
            $table->time('thursday_schedule')->nullable();
            $table->time('friday_schedule')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
