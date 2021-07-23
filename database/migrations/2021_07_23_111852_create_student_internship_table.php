<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInternshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_internship', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('internship_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->unsignedInteger('restored_by')->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('internship_id')->references('id')->on('internships');
            $table->foreign('supervisor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_internship');
    }
}
