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
            $table->string('facility_type')->nullabele();
            $table->string('facility_type_category')->nullabele();
            $table->string('owner')->nullabele();
            $table->string('owner_type')->nullabele();
            $table->string('regulatory_body')->nullabele();
            $table->string('beds')->nullabele();
            $table->string('cots')->nullabele();
            $table->string('county')->nullabele();
            $table->string('sub_county')->nullabele();
            $table->string('ward')->nullabele();
            $table->string('operation_status')->nullabele();
            $table->string('open_whole_day')->nullabele();
            $table->string('open_public_holidays')->nullabele();
            $table->string('open_weekends')->nullabele();
            $table->string('open_late_night')->nullabele();
            $table->string('service_names')->nullabele();
            $table->string('approved')->nullabele();
            $table->string('public_visible')->nullabele();
            $table->string('closed')->nullabele();
            $table->string('active')->nullabele();
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
