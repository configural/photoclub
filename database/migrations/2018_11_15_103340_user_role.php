<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
                    Schema::table('users', function(Blueprint $table) {
                    $table->integer('admin');});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
            Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('admin');
        });
    }
}
