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
        $product  = Product::all();

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
            'descripcion' => 'required',
            'foto' => 'required',
            'maximo' => 'required',
            'minimo' => 'required',
            'existencia' => 'required',
            'seguridad' => 'required',
            'id_measure' => 'required',
            'id_brand' => 'required',
            'id_warehouse' => 'required',
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
            'name',
            'foto',
            'maximo',
            'minimo',
            'existencia',
            'seguridad',
            'id_measure',
            'id_brand',
            'id_warehouse',
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
