<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserForPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_address', 255)->nullable()->default(null)->unique()->after('contact_number');
            $table->text('introduce_self')->nullable()->default(null)->after('area_id');
            $table->dropColumn('country');
            $table->dropColumn('country_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('province', 255)->nullable()->default(null)->after('unread_message');
            $table->string('province_en', 255)->nullable()->default(null)->after('province');
            $table->unsignedInteger('province_id')->nullable()->default(null)->after('province_en');
            $table->string('city_en', 255)->nullable()->default(null)->after('city');
            $table->unsignedInteger('city_id')->nullable()->default(null)->change();
            $table->string('area_en', 255)->nullable()->default(null)->after('area');
            $table->unsignedInteger('area_id')->nullable()->default(null)->change();
        });

        Schema::table('region', function (Blueprint $table) {
            $table->primary(array('id'));
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('province_id')
                ->references('id')->on('region')
                ->onDelete('set null');
            $table->foreign('city_id')
                ->references('id')->on('region')
                ->onDelete('set null');
            $table->foreign('area_id')
                ->references('id')->on('region')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_area_id_foreign');
            $table->dropForeign('users_city_id_foreign');
            $table->dropForeign('users_province_id_foreign');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_address');
            $table->dropColumn('introduce_self');
            $table->dropColumn('province');
            $table->dropColumn('province_en');
            $table->dropColumn('province_id');
            $table->dropColumn('area_en');
            $table->dropColumn('city_en');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('country', 255)->nullable()->default(null)->after('unread_message');
            $table->string('country_id', 255)->nullable()->default(null)->after('unread_message');
            $table->string('city_id', 255)->nullable()->default(null)->change();
            $table->string('area_id', 255)->nullable()->default(null)->change();
        });
    }
}
