<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyOrganizationPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sur_survey_organization_person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();

            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('date')->nullable();
            $table->integer('person')->nullable();
            $table->integer('ordering')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('survey_id')
                ->references('id')->on('sur_survey')
                ->onDelete('cascade');

            $table->foreign('organization_id')
                ->references('id')->on('sur_organization')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sur_survey_organization_person');
    }
}
