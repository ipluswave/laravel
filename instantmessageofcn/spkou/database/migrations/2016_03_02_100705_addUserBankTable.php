<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('bank')->truncate();
        Schema::table('bank', function (Blueprint $table) {
            $table->string('logo', 255)->after('name_en');
            $table->string('background_color', 10)->after('logo');
            $table->string('font_color', 10)->after('background_color');
        });
        Schema::create('users_bank', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->string('account_name', 255);
            $table->string('account_number', 255);
            $table->string('account_address', 255);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->softDeletes();
        });
        Schema::table('users_bank', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('bank_id')
                ->references('id')->on('bank')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->dropColumn('background_color');
            $table->dropColumn('font_color');
        });
        Schema::dropIfExists('users_bank');
    }
}
