<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExposureProgramInteger extends Migration
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
           // $table->integer('ExposureProgram')->change();
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
      //  $table->text('ExposureProgram')->change();
        });
    }
    
}
