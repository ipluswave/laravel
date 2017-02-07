<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustOrder1003 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable()->default(null)->after('horiz');
            $table->dropColumn('category');
            $table->dropColumn('category_type');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('category')
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
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->tinyInteger('category')->after('horiz');
            $table->tinyInteger('category_type')->after('category');
        });
    }
}
