<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->char('active', 3);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('instructor_id');
            $table->timestamps();

            $table->foreign('instructor_id', 'fk_instructor_training_sheet')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_users_training_sheet')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_sheets');
    }
}
