<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan', 80);
            $table->decimal('value', 6, 2);
            $table->char('paid_out', 3)->nullable();
            $table->date('stat_date');
            $table->date('end_date');
            $table->char('active', 3);
            $table->unsignedInteger('users_id');
            $table->timestamps();

            $table->foreign('users_id', 'fk_plans_users')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
