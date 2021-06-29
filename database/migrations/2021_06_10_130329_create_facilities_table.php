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
            $table->string('facility_type')->nullable();
            $table->string('facility_type_category')->nullable();
            $table->string('owner')->nullable();
            $table->string('owner_type')->nullable();
            $table->string('regulatory_body')->nullable();
            $table->string('beds')->nullable();
            $table->string('cots')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('ward')->nullable();
            $table->string('operation_status')->nullable();
            $table->string('open_whole_day')->nullable();
            $table->string('open_public_holidays')->nullable();
            $table->string('open_weekends')->nullable();
            $table->string('open_late_night')->nullable();
            $table->string('service_names')->nullable();
            $table->string('approved')->nullable();
            $table->string('public_visible')->nullable();
            $table->string('closed')->nullable();
            $table->string('active')->nullable();
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
