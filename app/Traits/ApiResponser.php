<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser{

    private function successResponser($data, $code){
        return response()->json($data,$code);
    }

    protected function errorResponser($message, $code = 200){
        return response()->json(['error => $message', $code => $code], $code);
    }

    private function showAll(Collection $collection, $code = 200){
        return $this->successResponser(['data' => $collection],$code);
    }

    private function showOne(Model $instance, $code = 200){
        return $this->successResponser(['data' => $instance], $code);
    }
    
}