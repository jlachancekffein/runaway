<?php

use App\Models\Province;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->timestamps();
        });

        $provinces = [
            'alberta',
            'british-columbia',
            'manitoba',
            'new-brunswick',
            'newfoundland-and-labrador',
            'northwest-territories',
            'nova-scotia',
            'nunavut',
            'ontario',
            'prince-edward-island',
            'quebec',
            'saskatchewan',
            'yukon',
        ];

        foreach ($provinces as $province) {
            Province::create([
                'key' => $province
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provinces');
    }
}
