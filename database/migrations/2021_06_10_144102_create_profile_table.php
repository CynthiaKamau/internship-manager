<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->integer('reg_number');
            $table->integer('index_number');
            $table->integer('id_number');
            $table->enum('gender',['MALE', 'FEMALE', 'TRANS-GENDER', 'OTHER']);
            $table->date('dob');
            $table->string('citizenship');
            $table->string('address');
            $table->string('profile_photo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('facility_id');
            $table->unsignedBigInteger('cadre_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('licence_id');
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('facility_id')->references('id')->on('facilities');
            $table->foreign('cadre_id')->references('id')->on('cadres');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('licence_id')->references('id')->on('licenses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
