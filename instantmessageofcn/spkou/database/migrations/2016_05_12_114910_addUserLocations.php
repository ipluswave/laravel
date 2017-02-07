<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_locations', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('country', 255)->nullable()->default(null);
            $table->string('country_id', 255)->nullable()->default(null);
            $table->string('area', 255)->nullable()->default(null);
            $table->string('area_id', 255)->nullable()->default(null);
            $table->string('region', 255)->nullable()->default(null);
            $table->string('region_id', 255)->nullable()->default(null);
            $table->string('city', 255)->nullable()->default(null);
            $table->string('city_id', 255)->nullable()->default(null);
            $table->text('api_response')->nullable()->default(null);
            $table->string('ip_address', 255);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('users_locations', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('country', 255)->nullable()->default(null);
            $table->string('country_id', 255)->nullable()->default(null);
            $table->string('area', 255)->nullable()->default(null);
            $table->string('area_id', 255)->nullable()->default(null);
            $table->string('region', 255)->nullable()->default(null);
            $table->string('region_id', 255)->nullable()->default(null);
            $table->string('city', 255)->nullable()->default(null);
            $table->string('city_id', 255)->nullable()->default(null);
            $table->string('last_login_ip_address', 255)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_locations');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('country_id');
            $table->dropColumn('area');
            $table->dropColumn('area_id');
            $table->dropColumn('region');
            $table->dropColumn('region_id');
            $table->dropColumn('city');
            $table->dropColumn('city_id');
            $table->dropColumn('last_login_ip_address');
        });
    }
}
