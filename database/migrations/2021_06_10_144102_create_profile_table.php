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
            $table->string('username')->nullable();
            $table->integer('reg_number')->nullable();
            $table->integer('index_number')->nullable();
            $table->integer('id_number')->nullable();
            $table->enum('gender',['MALE', 'FEMALE', 'TRANS-GENDER', 'OTHER'])->nullable();
            $table->date('dob')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_photo')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->unsignedBigInteger('cadre_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('licence_id')->nullable();
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
