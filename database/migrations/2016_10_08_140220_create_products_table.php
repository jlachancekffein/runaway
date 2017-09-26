<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kit_id');
            $table->string('transaction_id')->nullable();
            $table->string('name');
            $table->float('regular_price');
            $table->float('reduced_price')->nullable();
            $table->string('marker_x');
            $table->string('marker_y');
            $table->string('brand');
            $table->timestamps();

            $table->index(['kit_id', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
