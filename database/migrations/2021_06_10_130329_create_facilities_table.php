<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code');
            $table->string('name');
            $table->string('official_name');
            $table->string('registration_number');
            $table->string('keph_level');
            $table->string('facility_type');
            $table->string('facility_type_category');
            $table->string('owner');
            $table->string('owner_type');
            $table->string('regulatory_body');
            $table->string('beds');
            $table->string('cots');
            $table->string('county');
            $table->string('sub_county');
            $table->string('ward');
            $table->string('operation_status');
            $table->string('open_whole_day');
            $table->string('open_public_holidays');
            $table->string('open_weekends');
            $table->string('open_late_night');
            $table->string('service_names');
            $table->string('approved');
            $table->string('public_visible');
            $table->string('closed');
            $table->string('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
