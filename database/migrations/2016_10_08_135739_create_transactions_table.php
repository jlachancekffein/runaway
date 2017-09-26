<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->enum('status', ['paid', 'sent', 'returned', 'refund'])->default('paid');
            $table->float('subtotal');
            $table->float('tax0');
            $table->float('tax1')->nullable();
            $table->boolean('express_shipping');
            $table->float('total');
            $table->string('stripe_transaction_id');
            $table->integer('kit_id');
            $table->string('tracking_number', 100)->nullable();
            $table->string('shipping_address', 100);
            $table->string('billing_address', 100);
            $table->timestamps();

            $table->index(['customer_id', 'status', 'kit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
