<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_configuration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('language',30)->nullable();
            $table->tinyInteger('status')->nullable()->comment('active = 1, inactive = 0');


            $table->string('created_by',10)->nullable();
            $table->string('updated_by',10)->nullable();
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
        Schema::dropIfExists('configurations');
    }
}
