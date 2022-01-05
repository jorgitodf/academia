<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayWeekTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_week_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day_week', 16);
            $table->unsignedInteger('training_sheets_id');
            $table->timestamps();

            $table->foreign('training_sheets_id', 'fk_fk_day_week_training_training_sheets')->references('id')->on('training_sheets')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_week_trainings');
    }
}
