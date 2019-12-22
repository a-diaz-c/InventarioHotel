<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Brand;
use App\Stock;
use App\Warehouse;
use App\Provider;
use App\SubWarehouse;
use App\Product;
use App\Measure;
use App\Buy;
use App\Out_product;
use App\Detail_buy;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;
    
    return [
        'name_user' => $faker->name,
        'password_user' => $password ?: $password = bcrypt('secret'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'nombre_brands' => $faker->company,
    ];
});


$factory->define(Stock::class, function (Faker $faker) {
    return [
        'maximo' => $faker->numberBetween(30,50),
        'minimo' => $faker->numberBetween(5,20),
        'seguridad' => $faker->numberBetween(10,20),
        'existencia' => $faker->numberBetween(1,50),
    ];
});

$factory->define(Warehouse::class, function (Faker $faker) {
    return [
        'nombre_warehouses' => $faker->sentence(2),
    ];
});

$factory->define(SubWarehouse::class, function (Faker $faker) {
    $warehouse = Warehouse::all()->random();
    return [
        'nombre_sub_warehouses' => $faker->sentence(2),
        'id_warehouses' => $warehouse->id,
    ];
});

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'nombre_providers' => $faker->company,
    ];
});

$factory->define(Measure::class, function (Faker $faker) {
    return [
        'descripcion_measures' => $faker->word,
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    $measure = Measure::all()->random();
    $brand = Brand::all()->random();
    $warehouse = Warehouse::all()->random();

    return [
        'descripcion_products' => $faker->catchPhrase,
        'foto_products' => $faker->imageUrl($width = 640, $height = 480),
        'maximo_products' => $faker->numberBetween(30,50),
        'minimo_products' => $faker->numberBetween(5,20),
        'seguridad_products' => $faker->numberBetween(10,20),
        'existencia_products' => $faker->numberBetween(1,50),
        'id_measures' => $measure->id,
        'id_brands'=> $brand->id,
        'id_warehouses' => $warehouse->id,
    ];
});

$factory->define(Out_product::class, function (Faker $faker) {
    $product = Product::all()->random();
    
    return [
        'fecha_out_products' => $faker->date('Y-m-d','now'),
        'cantidad_out_products' =>  $faker->numberBetween(1,10),
        'id_products'=> $product->id,
    ];
});

$factory->define(Buy::class, function (Faker $faker) {
    $provider = Provider::all()->random();
    
    return [
        'fecha_buys' => $faker->date('Y-m-d','now'),
        'descripcion_buys' =>  $faker->word,
        'id_providers'=> $provider->id,
    ];
});

$factory->define(Detail_buy::class, function (Faker $faker) {
    $product = Product::all()->random();
    $buy = Buy::all()->random();
    
    return [
        'id_products'=> $product->id,
        'id_buys' => $buy->id,
        'precio' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 200),
        'cantidad' => $faker->numberBetween(20,30),
    ];
});