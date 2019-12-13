<?php

use App\User;
use App\Brand;
use App\Stock;
use App\Measure;
use App\Warehouse;
use App\Provider;
use App\SubWarehouse;
use App\Out_product;
use App\Buy;
use App\Product;
use App\Detail_buy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        User::Truncate();
        Brand::Truncate();
        Buy::Truncate();
        Stock::Truncate();
        Measure::Truncate();
        Warehouse::Truncate();
        Provider::Truncate();
        SubWarehouse::Truncate();
        Out_product::Truncate();
        Product::Truncate();
        Detail_buy::Truncate();

        $cantidadUsers = 5;
        $cantidadBrand = 10;
        $cantidadStock = 5;
        $cantidadWarehouse = 10;
        $cantidaProvider = 5;
        $cantidadSubWarehouse = 10;
        $cantidadBuy = 8;
        $cantidaMeasure= 12;
        $cantidadOut_product = 30;
        $cantidadProduct = 30;
        $cantidadDetail = 50;


        factory(User::class, $cantidadUsers)->create();
        factory(Brand::class, $cantidadBrand)->create();
        factory(Stock::class, $cantidadStock)->create();
        factory(Warehouse::class, $cantidadWarehouse)->create();
        factory(SubWarehouse::class, $cantidadSubWarehouse)->create();
        factory(Provider::class, $cantidaProvider)->create();
        factory(Measure::class, $cantidaMeasure)->create();
        factory(Product::class, $cantidadProduct)->create();
        factory(Buy::class, $cantidadBuy)->create();
        factory(Out_product::class, $cantidadOut_product)->create();
        factory(Detail_buy::class, $cantidadDetail)->create();
    }
}
