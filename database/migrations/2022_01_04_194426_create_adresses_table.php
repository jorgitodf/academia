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
            $table->unsignedInteger('neighborhoods_id');
            $table->unsignedInteger('public_places_id');
            $table->unsignedInteger('users_id');
            $table->timestamps();

            $table->foreign('neighborhoods_id', 'fk_adresses_neighborhoods')->references('id')->on('neighborhoods')->onUpdate('cascade');
            $table->foreign('public_places_id', 'fk_adresses_public_places')->references('id')->on('public_places')->onUpdate('cascade');
            $table->foreign('users_id', 'fk_adresses_users')->references('id')->on('users')->onUpdate('cascade');
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
