<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('projects', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('uaer_id')->nullable();
            $table->timestamps();
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
    }
}
