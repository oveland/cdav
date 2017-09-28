<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45)->unique();
            $table->string('description',200)->nullable();
            $table->boolean('parent')->default(false);
            $table->integer('admission_reason_id')->unsigned()->nullable();
            $table->timestamps();

            /* table relations */
            $table->foreign('admission_reason_id')->references('id')->on('admission_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_reasons');
    }
}
