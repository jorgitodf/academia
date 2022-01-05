<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', 120);
			$table->date('birth_date');
			$table->string('profession', 120);
            $table->enum('gender', ['Masculino', 'Feminino']);
			$table->string('photo', 255);
            $table->string('email', 120);
            $table->string('password');
            $table->unsignedInteger('type_users_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('type_users_id', 'fk_type_users_users')->references('id')->on('type_users')->onUpdate('cascade');
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
