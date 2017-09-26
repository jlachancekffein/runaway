<?php

use App\Models\Province;
use App\Models\Tax;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->nullable();
            $table->double('percentage')->nullable();
            $table->unsignedInteger('province_id');
            $table->timestamps();
        });

        Province::all()->each(function (Province $province) {
            $province->taxes()->saveMany([
                new Tax([
                    'key' => null,
                    'percentage' => null
                ]),
                new Tax([
                    'key' => null,
                    'percentage' => null
                ]),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('taxes');
    }
}
