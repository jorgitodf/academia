<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalEvaluationFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_evaluation_form', function (Blueprint $table) {
            $table->increments('id');
            $table->date('valuation');
            $table->date('revaluation');
            $table->char('active', 3);
            $table->string('objective', 30);
            $table->string('activity', 30);
            $table->string('pathologies', 200);
            $table->string('injuries_surgeries', 200);
            $table->string('controlled_medication', 200);
            $table->char('smoking', 3);
            $table->char('alcoholic_beverage', 3);
            $table->float('weight');
            $table->double('height');
            $table->float('chest', 4, 2);
            $table->float('waist', 4, 2);
            $table->float('left_arm', 4, 2);
            $table->float('right_arm', 4, 2);
            $table->float('left_leg', 4, 2);
            $table->float('right_leg', 4, 2);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('instructor_id');
            $table->timestamps();

            $table->foreign('instructor_id', 'fk_instructor_physical_evaluation_form')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_users_physical_evaluation_form')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_evaluation_form');
    }
}
