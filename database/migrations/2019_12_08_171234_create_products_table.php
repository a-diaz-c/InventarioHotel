<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('foto');
            $table->integer('maximo')->unsigned();
            $table->integer('minimo')->unsigned();
            $table->integer('existencia')->unsigned();
            $table->integer('seguridad')->unsigned();
            $table->bigInteger('id_measure')->unsigned();
            $table->bigInteger('id_brand')->unsigned();
            $table->bigInteger('id_warehouse')->unsigned();
            $table->timestamps();

            $table->foreign('id_warehouse')->references('id')->on('warehouses');
            $table->foreign('id_measure')->references('id')->on('measures');
            $table->foreign('id_brand')->references('id')->on('brands');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
