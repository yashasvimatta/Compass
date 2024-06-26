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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('role')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('cpassword')->nullable();
            $table->binary('profile_pic')->nullable();
            $table->string('institution')->nullable();
            $table->string('education')->nullable();
            $table->string('research_field')->nullable();
            $table->string('experience')->nullable();
            $table->string('race')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->binary('resume')->nullable();
            $table->binary('cv')->nullable();
            $table->string('statement')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
