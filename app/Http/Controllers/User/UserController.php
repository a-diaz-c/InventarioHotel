<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios  = User::all();

        return response()->json(['data' => $usuarios], 201);
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
            'name' => 'required|unique:users',
            'password' => 'required|min:6:confirmed'
        ];

        $this->validate($request,$reglas);

        $campos = $request->all();
        $campos['password'] = bcrypt($request->password);

        $usuario = User::create($campos);

        return response()->json(['data' => $usuario], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return response()->json(['data' => $usuario], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $reglas = [
            'name' => 'unique:users,name,' . $user->id,
            'password' => 'min:6|confirmed' 
        ];

        $this->validate($request, $reglas);

        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if(!$user->isDirty()){
            return response()->json(['error' => 'Se debe especificar al menos in valor diferente para actulizar', 'code' => 422], 422);
        }

        $user->save();

        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['data' => $user], 200);
    }
}
