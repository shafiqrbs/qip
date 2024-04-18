<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('name',30)->nullable();
            $table->string('email',40)->nullable()->unique();
            $table->string('mobile',14)->nullable();
            $table->string('address',100)->nullable();
            $table->string('password',100)->nullable();

            $table->enum('type',array('Admin','Vendor','Customer','User'));
            $table->string('user_image',100)->nullable();
            $table->enum('status',array('1','0'))->nullable()->comment('active = 1, inactive = 0');

            $table->string('created_by',10)->nullable();
            $table->string('updated_by',10)->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('organization_id')
                ->references('id')->on('sur_organization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
