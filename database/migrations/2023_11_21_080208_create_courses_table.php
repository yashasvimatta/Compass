<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('course_id');
            $table->integer('user_id');
            $table->string('branch_name')->nullable();
            $table->string('department_code')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_name');
            $table->string('assigned_guide_name')->nullable();
            $table->text('course_desc')->nullable();
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
