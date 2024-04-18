<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sur_survey', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameen',30)->nullable();
            $table->string('namebn',30)->nullable();
            $table->string('discriptionen',100)->nullable();
            $table->string('discriptionbn',100)->nullable();
            $table->string('mode',11)->nullable();
            $table->tinyInteger('status')->nullable()->comment('active = 1, inactive = 0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sur_survey');
    }
}
