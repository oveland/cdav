<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsProprietariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_proprietaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity',20);
            $table->string('name',45);
            $table->string('address',45)->nullable();
            $table->string('phone',45)->nullable();
            $table->string('email',45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_proprietaries');
    }
}
