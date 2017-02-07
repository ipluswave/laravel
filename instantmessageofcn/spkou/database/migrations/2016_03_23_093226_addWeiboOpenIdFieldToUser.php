<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeiboOpenIdFieldToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('qq_open_id', 255)->nullable()->default(null)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('weibo_open_id', 255)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('qq_open_id', 255)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('weibo_open_id');
        });
    }
}
