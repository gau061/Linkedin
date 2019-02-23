<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('group_title')->nullable();
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('group_image')->nullable();
            $table->string('industry')->nullable();
            $table->tinyInteger('group_status')->default(0);
            $table->longText('group_rules')->nullable();
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
        Schema::dropIfExists('group_profiles');
    }
}
