<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPingPPTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->unsignedTinyInteger('payment_method');
            $table->text('order_no');
            $table->text('transaction_id');
            $table->text('channel');
            $table->text('ip_address');
            $table->text('currency');
            $table->decimal('amount', 12, 2)->default('0.00');
            $table->decimal('amount_refunded', 12, 2)->default('0.00');
            $table->decimal('amount_settle', 12, 2)->default('0.00');
            $table->text('create_transaction_json');
            $table->unsignedInteger('status')->default(0);
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });

        Schema::table('order_payment', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')->on('order')
                ->onDelete('set null');
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('order_payment');
    }
}
