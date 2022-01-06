<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registration', 9);
            $table->date('start_date');
            $table->date('end_date');
            $table->char('paid_out', 3)->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('form_payment_id');
            $table->timestamps();

            $table->foreign('user_id', 'fk_plans_users')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('plan_id', 'fk_users_plans')->references('id')->on('plans')->onUpdate('cascade');
            $table->foreign('form_payment_id', 'fk_form_payment_plans')->references('id')->on('form_payment')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_plans');
    }
}
