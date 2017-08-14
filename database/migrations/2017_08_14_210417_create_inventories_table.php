<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->string('number')->nullable();
            $table->integer('inventory_process_id')->unsigned();
            $table->integer('admission_reason_id')->unsigned();
            $table->integer('cars_inventory_id')->unsigned();
            $table->timestamps();

            /* table relations */
            $table->foreign('inventory_process_id')->references('id')->on('inventory_processes')->onDelete('cascade');
            $table->foreign('admission_reason_id')->references('id')->on('admission_reasons')->onDelete('cascade');
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
        Schema::dropIfExists('inventories');
    }
}
