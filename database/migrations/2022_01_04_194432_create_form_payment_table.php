<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_method', 60);
            $table->unsignedInteger('plans_id');
            $table->timestamps();

            $table->foreign('plans_id', 'fk_plans_form_payment')->references('id')->on('plans')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_payment');
    }
}
