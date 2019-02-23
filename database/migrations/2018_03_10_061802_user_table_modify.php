<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTableModify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('current_login')->after('email')->nullable();
            $table->string('last_login')->after('current_login')->nullable();
            $table->string('brith_date')->after('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('current_login');
            $table->dropColumn('last_login');
            $table->dropColumn('brith_date');
        });
        
    }
}
