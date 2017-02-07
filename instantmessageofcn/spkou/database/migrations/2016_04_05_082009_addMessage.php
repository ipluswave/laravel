<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('unread_message')->default(0);
        });
        Schema::create('users_inbox', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id')->nullable()->default(null);
            $table->unsignedInteger('from_user_id')->nullable()->default(null);
            $table->unsignedInteger('to_user_id')->nullable()->default(null);
            $table->unsignedTinyInteger('type');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::create('users_inbox_messages', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inbox_id');
            $table->unsignedInteger('from_user_id')->nullable()->default(null);
            $table->unsignedInteger('to_user_id')->nullable()->default(null);
            $table->unsignedInteger('order_id')->nullable()->default(null);
            $table->unsignedTinyInteger('is_read')->default(0);
            $table->unsignedTinyInteger('type');
            $table->text('custom_message')->nullable()->default(null);
            $table->text('custom_link')->nullable()->default(null);
            $table->text('translate_variable')->nullable()->default(null);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('users_inbox', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')->on('order')
                ->onDelete('cascade');
            $table->foreign('from_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('to_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('users_inbox_messages', function (Blueprint $table) {
            $table->foreign('inbox_id')
                ->references('id')->on('users_inbox')
                ->onDelete('cascade');
            $table->foreign('from_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('to_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('order_id')
                ->references('id')->on('order')
                ->onDelete('cascade');
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
            $table->dropColumn('unread_message');
        });
        Schema::dropIfExists('users_inbox_messages');
        Schema::dropIfExists('users_inbox');
    }
}
