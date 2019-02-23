<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('post_title')->nullable();
            $table->longText('post_desc')->nullable();
            $table->tinyInteger('post_type')->nullable();
            $table->tinyInteger('post_status')->default(1);
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
        Schema::dropIfExists('group_feeds');
    }
}
