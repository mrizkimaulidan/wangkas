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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained();
            $table->foreignId('school_major_id')->constrained();
            $table->string('identification_number');
            $table->string('name');
            $table->string('phone_number');
            $table->tinyInteger('gender');
            $table->integer('school_year_start');
            $table->integer('school_year_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
