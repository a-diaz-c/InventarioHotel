<?php

namespace App\CodeClass;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Validator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;


class Actions
{
    public static function sortData(Collection $collection)
    {
        if(request()->has('sort_by')){
            $attribute = request()->sort_by;

            $collection = $collection->sortBy->{$attribute};
        }        
        return $collection;
    }

    public static function filterData(Collection $collection)
    {
        foreach (request()->query() as $query => $value) {
            if($query == "sort_by" || $query == "page" || 'per_page') continue;

            if(isset($query, $value)){
                $collection = $collection->where($query,$value);
            }
        }
        return $collection;
    }

    public static function paginate(Collection $collection){

        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];

        request()->validate($rules);
        
        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 10;
        if(request()->has('per_page')){
            $perPage = (int) request()->per_page;
        }

        $results = $collection->slice(($page-1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page,[
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]); 

        $paginated->appends(request()->all());

        return $paginated;



       /*request()->validate($rules);

       $perPage = 18;

       if(request()->has('per_page')){
           $perPage = (int) request()->per_page;
       }
        return $perPage;*/
    }
}
