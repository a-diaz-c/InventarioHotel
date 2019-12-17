<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $product  = Product::join('measures', 'products.id_measures', '=', 'measures.id_measures')
                            ->join('brands','products.id_brands','=','brands.id_brands')
                            ->join('warehouses', 'products.id_warehouses', '=', 'warehouses.id_warehouses')
                            ->select('products.*','descripcion_measures','brands.nombre_brands','warehouses.nombre_warehouses')
                            ->get();

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

        $product = Product::create($campos);

        return response()->json(['data' => $product], 201);
        return response()->json($request, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //$product = Product::findOrFail($id);

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
        $product->delete();

        return response()->json(['data' => $product], 200);
    }
}
