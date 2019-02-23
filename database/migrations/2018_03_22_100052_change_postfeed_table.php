<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePostfeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_feed',function(Blueprint $table){
            $table->bigInteger('post_id')->unsigned()->change();
        });

        Schema::table('post_images',function(Blueprint $table){
            $table->bigInteger('post_id')->unsigned()->change();
        });

        Schema::table('post_video',function(Blueprint $table){
            $table->bigInteger('post_id')->unsigned()->change();
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
