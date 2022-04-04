<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreignId('school_major_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();;
            $table->string('student_identification_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->tinyInteger('gender');
            $table->integer('school_year_start');
            $table->integer('school_year_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
