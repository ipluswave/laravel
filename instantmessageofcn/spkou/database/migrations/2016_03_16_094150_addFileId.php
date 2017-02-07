<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('order_processing_guide')->truncate();
        Schema::table('order_processing_guide', function (Blueprint $table) {
            $table->text('file_id')->after('id')->default(null);
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
            $table->dropColumn('file_id');
        });
    }
}
