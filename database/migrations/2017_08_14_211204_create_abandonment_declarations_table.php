<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbandonmentDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abandonment_declarations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->string('resolution_number',45)->unique();
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
        Schema::dropIfExists('abandonment_declarations');
    }
}
