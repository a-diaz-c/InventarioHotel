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
            $table->bigIncrements('id_products');
            $table->string('descripcion_products');
            $table->string('foto_products');
            $table->integer('maximo_products')->unsigned();
            $table->integer('minimo_products')->unsigned();
            $table->integer('existencia_products')->unsigned();
            $table->integer('seguridad_products')->unsigned();
            $table->bigInteger('id_measures')->unsigned();
            $table->bigInteger('id_brands')->unsigned();
            $table->bigInteger('id_warehouses')->unsigned();
            $table->timestamps();

            $table->foreign('id_warehouses')->references('id_warehouses')->on('warehouses');
            $table->foreign('id_measures')->references('id_measures')->on('measures');
            $table->foreign('id_brands')->references('id_brands')->on('brands');            
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
