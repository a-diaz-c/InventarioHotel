<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_sub_warehouses');
            $table->bigInteger('id_warehouses')->unsigned();
            $table->timestamps();

            $table->foreign('id_warehouses')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_warehouses');
    }
}
