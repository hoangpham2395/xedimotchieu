<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->integer('user_from_id')->after('id');
            $table->integer('user_to_id')->after('user_from_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat', function (Blueprint $table) {
            $table->integer('user_id')->after('id');
            $table->dropColumn('user_from_id');
            $table->dropColumn('user_to_id');
        });
    }
}
