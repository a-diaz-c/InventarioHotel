<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_buys', function (Blueprint $table) {
            $table->bigInteger('id_buys')->unsigned();
            $table->bigInteger('id_products')->unsigned();
            $table->decimal('precio',10,2);
            $table->bigInteger('cantidad')->unsigned();
            $table->timestamps();

            $table->foreign('id_buys')->references('id')->on('buys');
            $table->foreign('id_products')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_buys');
    }
}
