<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsLimitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_limitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('limitation',45)->unique();
            $table->string('issuing',45);
            $table->string('motive',200);
            $table->string('description',200)->nullable();
            $table->integer('cars_inventory_id')->unsigned();
            $table->timestamps();

            /* table relations */
            $table->foreign('cars_inventory_id')->references('id')->on('cars_inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_limitations');
    }
}
