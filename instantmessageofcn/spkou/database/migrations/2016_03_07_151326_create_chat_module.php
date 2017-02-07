<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //creare chat rooms
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->string('topic', 255);
            $table->text('description');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        //set foreign
        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('staff_id')
                ->references('id')->on('staff')
                ->onDelete('set null');
        });

        //create chat follower
        Schema::create('chat_followers', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        //set foreign
        Schema::table('chat_followers', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });

        //create chat message
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('sender_user_id')->nullable();
            $table->unsignedInteger('sender_staff_id')->nullable();
            $table->unsignedInteger('receiver_user_id')->nullable();
            $table->unsignedInteger('receiver_staff_id')->nullable();
            $table->text('message');
            $table->text('file');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        //set foreign
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreign('room_id')
                ->references('id')->on('chat_rooms')
                ->onDelete('set null');
            $table->foreign('sender_user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('receiver_user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('sender_staff_id')
                ->references('id')->on('staff')
                ->onDelete('set null');
            $table->foreign('receiver_staff_id')
                ->references('id')->on('staff')
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
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_followers');
        Schema::dropIfExists('chat_rooms');
    }
}
