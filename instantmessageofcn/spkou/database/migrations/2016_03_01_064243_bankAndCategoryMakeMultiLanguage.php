<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankAndCategoryMakeMultiLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('category')->truncate();
        \DB::table('bank')->truncate();
        Schema::table('category', function (Blueprint $table) {
            $table->renameColumn('title', 'title_cn');
        });
        Schema::table('category', function (Blueprint $table) {
            $table->string('title_en', 255)->after('title_cn');
        });
        Schema::table('bank', function (Blueprint $table) {
            $table->renameColumn('name', 'name_cn');
        });
        Schema::table('bank', function (Blueprint $table) {
            $table->string('name_en', 255)->after('name_cn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->renameColumn('title_cn', 'title');
            $table->dropColumn('title_en');
        });
        Schema::table('bank', function (Blueprint $table) {
            $table->renameColumn('name_cn', 'name');
            $table->dropColumn('name_en');
        });
    }
}
