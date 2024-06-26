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
        Schema::create('student_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // Foreign key referencing the users table
            $table->foreignId('assignment_id')->constrained(); // Foreign key referencing the assignments table
            $table->integer('marks_obtained')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('grade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_assignments');
    }
};
