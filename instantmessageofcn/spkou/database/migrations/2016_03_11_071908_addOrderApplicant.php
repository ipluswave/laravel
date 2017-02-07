<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderApplicant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_applicants', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('rate_quality')->default(0);
            $table->unsignedTinyInteger('rate_communicate')->default(0);
            $table->unsignedTinyInteger('rate_speed')->default(0);
            $table->text('text_review')->nullable()->default(null);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_applicants', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('order_id')
                ->references('id')->on('order')
                ->onDelete('cascade');
        });
        Schema::create('order_logs', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment = "People who made this changes";
            $table->unsignedInteger('order_id');
            $table->unsignedTInyInteger('action_side')->comment = "0: customer; 1: tailor";
            $table->unsignedTinyInteger('type')->comment = "1: tailor take job, 2: customer declined, 3: customer confirmed, 4: order complete, 5: customer cancel, 6: review";
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        Schema::table('order_logs', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
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
        Schema::dropIfExists('order_applicant');
        Schema::dropIfExists('order_logs');
    }
}
