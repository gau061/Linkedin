<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_request', function (Blueprint $table) {
            $table->unsignedInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('frontusers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('reciver_id'); 
            $table->foreign('reciver_id')->references('id')->on('frontusers')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('request_status',['Pending','Connected'])->default('Pending');
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
        Schema::dropIfExists('friend_request');
    }
}
