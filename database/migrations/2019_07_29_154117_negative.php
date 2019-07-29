<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Negative extends Migration
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
            $table->integer('critic_level')->default(1);
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
            $table->dropColumn('critic_level');
        });
    }
}
