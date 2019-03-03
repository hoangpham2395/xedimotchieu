<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('city_from_id');
            $table->integer('city_to_id');
            $table->integer('district_from_id');
            $table->integer('district_to_id');
            $table->integer('car_id');
            $table->integer('type');
            $table->dateTime('date_start');
            $table->integer('cost');
            $table->string('phone', 15)->nullable();
            $table->string('image', 255)->nullable();
            $table->text('note');
            $table->string('tags', 512)->nullable();
            $table->timestamps();
            $table->char('del_flag', 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
