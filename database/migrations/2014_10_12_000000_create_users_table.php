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
        $this->down();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',25);
            $table->string('apellidos',25);
            $table->string('login',25);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('telefono');
            $table->string('provincia')->default('Islas Baleares');
            $table->string('avatar',30)->default('persona.jpg');
            $table->integer('tipo')->default('1');
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