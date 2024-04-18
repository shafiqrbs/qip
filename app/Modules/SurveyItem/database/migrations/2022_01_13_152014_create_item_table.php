<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sur_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id')->nullable();

            $table->string('itemtexten',50)->nullable();
            $table->string('itemtextbn',50)->nullable();
            $table->string('itemvalueen',100)->nullable();
            $table->string('itemvaluebn',100)->nullable();
            $table->string('color_code',20)->nullable();
            $table->integer('oredring')->nullable();

            $table->tinyInteger('status')->nullable()->comment('active = 1, inactive = 0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

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
        Schema::dropIfExists('sur_item');
    }
}
