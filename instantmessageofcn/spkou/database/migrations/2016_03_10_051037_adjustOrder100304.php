<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustOrder100304 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_material', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('order_material', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_processing_guide', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('order_processing_guide', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_property', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('order_property', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_conversation', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('order_conversation', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_cad', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('order_cad', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_size', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::table('order_size', function (Blueprint $table) {
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
