<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sur_organization', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30)->nullable();
            $table->string('address',255)->nullable();
            $table->string('mobile',11)->nullable();
            $table->string('email',30)->nullable()->unique();
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
        Schema::dropIfExists('sur_organization');
    }
}
