<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_requests', function (Blueprint $table) {
            $table->bigInteger('group_id')->unsigned();
            $table->unsignedInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('frontusers')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('group_user_status',['Invited','Requested'])->default('Requested');
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
        Schema::dropIfExists('group_requests');
    }
}
