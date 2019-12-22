<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\CodeClass\Actions;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product  = Product::join('measures', 'products.id_measures', '=', 'measures.id')
                            ->join('brands','products.id_brands','=','brands.id')
                            ->join('warehouses', 'products.id_warehouses', '=', 'warehouses.id')
                            ->select('products.*','descripcion_measures','brands.nombre_brands','warehouses.nombre_warehouses')
                            ->get();
        
        $product = Actions::filterData($product);
        $product = Actions::sortData($product);
        $product = Actions::paginate($product);
        //$product = Product::paginate(Actions::paginate());

        return response()->json(['data' => $product], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'descripcion_products' => 'required',
            'foto_products' => 'required',
            'maximo_products' => 'required',
            'minimo_products' => 'required',
            'existencia_products' => 'required',
            'seguridad_products' => 'required',
            'id_measures' => 'required',
            'id_brands' => 'required',
            'id_warehouses' => 'required',
        ];

        $this->validate($request,$reglas);
        

        $campos = $request->all();

        $campos['foto_products'] = $request->file('foto_products')->store('');

        $product = Product::create($campos);

        return response()->json(['data' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product  = Product::join('measures', 'products.id_measures', '=', 'measures.id')
                            ->join('brands','products.id_brands','=','brands.id')
                            ->join('warehouses', 'products.id_warehouses', '=', 'warehouses.id')
                            ->select('products.*','descripcion_measures','brands.nombre_brands','warehouses.nombre_warehouses')
                            ->firstOrFail();

        return response()->json(['data' => $product], 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {      
        $imgDelete = $product->foto_products;

        $product->fill($request->only([
            'name_products',
            'foto_products',
            'maximo_products',
            'minimo_products',
            'existencia_products',
            'seguridad_products',
            'id_measures',
            'id_brands',
            'id_warehouses',
        ]));


        if($request->hasFile('foto_products')){
            Storage::delete($imgDelete);

            $product->foto_products= $request->file('foto_products')->store('');
        }

        if($product->isClean()){
            return response()->json(['error' => 'Debe especificar al menos un valor diferente para actualizar', 'code' => 422], 422);
        }

        $product->save();

        return response()->json(['data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->foto_products);
        
        $product->delete();

        return response()->json(['data' => $product], 200);
    }

}
