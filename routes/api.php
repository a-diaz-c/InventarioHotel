<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::resource('products','Product\ProductController',['only' => ['index','show']]); //especifica los verbo que se usaran

Route::resource('brands','Brand\BrandController',['except' => ['create','edit']]);
Route::resource('buys','Buy\BuyController',['except' => ['create','edit']]);
Route::resource('measures','Measure\MeasureController',['except' => ['create','edit']]);
Route::resource('out_products','Out_product\Out_productController',['except' => ['create','edit']]);
Route::resource('products','Product\ProductController',['except' => ['create','edit']]);
Route::resource('providers','Provider\ProviderController',['except' => ['create','edit']]);
Route::resource('stocks','Stock\StockController',['except' => ['create','edit']]);
Route::resource('subWarehouses','SubWarehouse\SubWarehouseController',['except' => ['create','edit']]);
Route::resource('users','User\UserController',['except' => ['create','edit']]);
Route::resource('warehouses','Warehouse\WarehouseController',['except' => ['create','edit']]);
