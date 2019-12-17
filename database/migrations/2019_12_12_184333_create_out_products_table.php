<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_products', function (Blueprint $table) {
            $table->bigIncrements('id_out_products');
            $table->date('fecha_out_products');
            $table->integer('cantidad_out_products')->unsigned();
            $table->bigInteger('id_products')->unsigned();
            $table->timestamps();

            $table->foreign('id_products')->references('id_products')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('out_products');
    }
}
