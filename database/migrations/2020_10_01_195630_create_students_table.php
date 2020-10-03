<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('std_id');
            $table->string('std_full_name');
            $table->string('std_father_name');
            $table->string('std_mother_name');
            $table->integer('std_roll');
            $table->integer('std_registration');
            $table->string('std_phone');
            $table->string('std_image')->nullable();
            $table->unsignedBigInteger('std_dept_id')->nullable();
            $table->tinyInteger('std_gender')->nullable();
            $table->string('std_email')->nullable();
            $table->string('std_bllod')->nullabale();
            $table->unsignedBigInteger('std_section_id')->nullable();
            $table->unsignedBigInteger('std_class_id')->nullable();
            $table->string('std_dob')->nullable();


            $table->timestamps();
         
            $table->foreign('std_dept_id')->references('dep_id')->on('departments')->onDelete('cascade');
            $table->foreign('std_class_id')->references('clas_id')->on('student_classes')->onDelete('cascade');
            $table->foreign('std_section_id')->references('sec_id')->on('student_sections')->onDelete('cascade');

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
