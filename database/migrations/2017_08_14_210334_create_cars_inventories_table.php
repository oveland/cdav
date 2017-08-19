<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate',7);
            $table->string('engine_number',45);
            $table->string('chassis_number',45);
            $table->string('model',4);
            $table->string('color',20);
            $table->string('registration_city',45);
            $table->boolean('pending_judicial')->default(false);
            $table->integer('inventory_id')->unsigned();
            $table->integer('cars_state_id')->unsigned();
            $table->integer('cars_proprietary_id')->unsigned();
            $table->timestamps();

            /* table relations */
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('cars_state_id')->references('id')->on('cars_states')->onDelete('cascade');
            $table->foreign('cars_proprietary_id')->references('id')->on('cars_proprietaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_inventories');
    }
}
