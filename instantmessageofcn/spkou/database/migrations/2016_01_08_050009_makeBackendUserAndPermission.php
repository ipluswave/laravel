<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeBackendUserAndPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::create('staff', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->string('username', 64)->unique();
            $table->string('email')->unique();
            $table->text('name');
            $table->string('password', 60);
            $table->rememberToken();
            $table->unsignedTinyInteger('staff_type');
            $table->unsignedInteger('permission_group_id')->nullable()->default(null);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });

        Schema::create('permission_groups', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->string('group_name', 255);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });

        Schema::create('permission_groups_permissions', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('permission_group_id');
            $table->text('permission_tag');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('permission_group_id')
                ->references('id')->on('permission_groups')
                ->onDelete('set null');
        });

        Schema::table('permission_groups_permissions', function (Blueprint $table) {
            $table->foreign('permission_group_id')
                ->references('id')->on('permission_groups')
                ->onDelete('cascade');
        });

        $m = new \App\Models\Staff();
        $m->email = 'admin@admin.com';
        $m->name = 'Administrator';
        $m->username = 'admin';
        $m->password = 'qweasd';
        $m->staff_type = \App\Models\Staff::STAFF_TYPE_ADMIN;

        $m->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
        });
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('permission_groups_permissions');
        Schema::dropIfExists('permission_groups');
        Schema::dropIfExists('staff');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
