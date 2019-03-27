<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Userdata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
                    
                    Schema::create('statuses', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('name');
                    });
        
                    Schema::table('users', function(Blueprint $table) {
                    $table->integer('status')->default('1');
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
        
            Schema::drop('statuses');
            Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('status');
            
        });
    }
}
