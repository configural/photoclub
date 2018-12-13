<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExifData2Photos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('photos', function(Blueprint $table) {
            $table->text('Make');
            $table->text('Model');
            $table->text('FocalLength');
            $table->text('ExposureProgram');
            $table->text('ExposureTime');
            $table->text('FNumber');
            $table->text('ISOSpeedRatings');
            $table->text('ExposureBiasValue');
            $table->text('Software');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
           Schema::table('photos', function(Blueprint $table) {
            $table->dropcolumn('Make');
            $table->dropcolumn('Model');
            $table->dropcolumn('FocalLength');
            $table->dropcolumn('ExposureProgram');
            $table->dropcolumn('ExposureTime');
            $table->dropcolumn('FNumber');
            $table->dropcolumn('ISOSpeedRatings');
            $table->dropcolumn('ExposureBiasValue');
            $table->dropcolumn('Software');
        });
    }
}

