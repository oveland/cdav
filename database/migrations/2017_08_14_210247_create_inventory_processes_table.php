<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->boolean('pending_judicial')->default(false);
            $table->integer('cars_limitation_id')->unsigned();
            $table->integer('abandonment_declaration_id')->unsigned();
            $table->timestamps();

            /* table relations */
            $table->foreign('cars_limitation_id')->references('id')->on('cars_limitations')->onDelete('cascade');
            $table->foreign('abandonment_declaration_id')->references('id')->on('abandonment_declarations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_processes');
    }
}
