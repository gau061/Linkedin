<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrouppostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouppost_comments', function (Blueprint $table) {
            $table->bigInteger('group_id');
            $table->bigInteger('feed_post_id')->unsigned();
            $table->bigInteger('post_user_id')->unsigned();
            $table->bigInteger('commenter_user_id')->unsigned();
            $table->text('post_comment');
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
        Schema::dropIfExists('grouppost_comments');
    }
}
