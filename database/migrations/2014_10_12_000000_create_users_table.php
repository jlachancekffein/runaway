<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('avatar')->nullable();
            $table->text('preferences')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['name', 'email', 'role']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
