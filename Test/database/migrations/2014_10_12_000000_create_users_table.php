<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isAdmin')->default(false);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('street');
            $table->integer('street_number');
            $table->integer('zip_code');
            $table->string('city');
            $table->string('country');
            $table->rememberToken();
            $table->timestamps();


        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}