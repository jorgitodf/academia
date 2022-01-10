<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 80);
            $table->string('complement', 30);
            $table->string('number', 10);
            $table->char('zip_code', 8);
            $table->string('neighborhoods', 120);
            $table->string('cities', 100);
            $table->char('states', 2);
            $table->unsignedInteger('public_place_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('public_place_id', 'fk_adresses_public_places')->references('id')->on('public_places')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_adresses_users')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresses');
    }
}
