<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('first_name',50);
            $table->string('last_name',50)->nullable();
            $table->string('email',100)->unique();
            $table->string('password',255);
            $table->integer('phone')->unique();
            // $table->string('country',50)->nullable();
            // $table->string('city',50)->nullable();
            // $table->string('state',50)->nullable();
            // $table->string('postal_code',50)->nullable();
            // $table->text('address1')->nullable();
            // $table->text('address2')->nullable();
            $table->integer('fk_role_id')->unsigned();
            $table->tinyInteger('status')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
