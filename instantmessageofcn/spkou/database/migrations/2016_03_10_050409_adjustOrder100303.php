<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustOrder100303 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('top_n_bottom');
            $table->dropColumn('style');
            $table->unsignedInteger('style_id')->nullable()->default(null)->after('horiz');
            $table->unsignedInteger('top_bottom_id')->nullable()->default(null)->after('style_id');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('style_id')
                ->references('id')->on('category')
                ->onDelete('set null');
            $table->foreign('top_bottom_id')
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
            $table->dropColumn('style_id');
            $table->dropColumn('top_bottom_id');
            $table->tinyInteger('style')->after('seal1');
            $table->tinyInteger('top_n_bottom')->after('body_shape');
        });
    }
}
