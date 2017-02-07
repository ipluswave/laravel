<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportOrderSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_size', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->smallInteger('size');
            $table->string('size_type', 45);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_size', function (Blueprint $table) {
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
        Schema::dropIfExists('order_size');
    }
}
