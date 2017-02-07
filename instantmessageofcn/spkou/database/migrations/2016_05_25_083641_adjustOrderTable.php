<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function ($table) {
            $table->smallInteger('parar')->signed()->change();
            $table->smallInteger('horiz')->signed()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function ($table) {
            $table->unsignSmallInteger('parar')->change();
            $table->unsignSmallInteger('horiz')->change();
        });
    }
}
