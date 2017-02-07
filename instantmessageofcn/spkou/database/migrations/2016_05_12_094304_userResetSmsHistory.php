<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserResetSmsHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_reset_verifications', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('contact_number', 255);
            $table->string('code', 64);
            $table->text('params')->nullable()->default(null);
            $table->string('ip_address', 64);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('users_reset_verifications', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('users_reset_verifications');
    }
}
