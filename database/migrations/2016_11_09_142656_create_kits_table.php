<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable();
            $table->integer('kit_request_id')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['draft', 'pending', 'seen', 'sold'])->default('draft');
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'kit_request_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kits');
    }
}
