<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToOrderProcessingGuide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_processing_guide', function (Blueprint $table) {
            $table->dropForeign('fk_order_processing_guide_order1');
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
        Schema::table('order_processing_guide', function (Blueprint $table) {
            $table->dropForeign('order_processing_guide_order_id_foreign');
            $table->foreign('order_id')
                ->references('id')->on('order');
        });
    }
}
