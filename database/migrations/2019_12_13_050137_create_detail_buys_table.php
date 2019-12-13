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
            $table->bigInteger('id_buy')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->decimal('precio',10,2);
            $table->bigInteger('cantidad')->unsigned();
            $table->timestamps();

            $table->foreign('id_buy')->references('id')->on('buys');
            $table->foreign('id_product')->references('id')->on('products');
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
