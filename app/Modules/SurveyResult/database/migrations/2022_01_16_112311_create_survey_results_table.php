<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sur_survey_result', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id')->nullable();

            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('device_id')->nullable();

            $table->string('survey_value','255')->nullable();
            $table->string('latitude','255')->nullable();
            $table->string('longitude','255')->nullable();
            $table->string('date')->nullable();

            $table->tinyInteger('status')->nullable()->comment('active = 1, inactive = 0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('item_id')
                ->references('id')->on('sur_item');
//                ->onDelete('cascade');
            $table->foreign('organization_id')
                ->references('id')->on('sur_organization');
//                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users');
//                ->onDelete('cascade');
            $table->foreign('survey_id')
                ->references('id')->on('sur_survey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sur_survey_result');
    }
}
