<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificationSms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number', 255)->nullable()->default(null)->after('email');
            $table->string('email', 255)->nullable()->default(null)->change();
        });
        Schema::create('users_contact_verifications', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('contact_number', 255);
            $table->string('code', 64);
            $table->text('params')->nullable()->default(null);
            $table->string('ip_address', 64);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('users_contact_verifications', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_number');
            $table->string('email', 255)->change();
        });
        Schema::dropIfExists('users_contact_verifications');
    }
}
