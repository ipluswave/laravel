<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->string('title', 255);
            $table->unsignedTinyInteger('level');
            $table->unsignedTinyInteger('selectable');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->softDeletes();
        });

        Schema::table('category', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')->on('category')
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
        Schema::dropIfExists('category');
    }
}
