<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService{

    public function store($request){

        if(Supplier::updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
        ])){
            return back()->with(['msg'=>'Successfully Saved']);
        }else{
            return back()->with(['msg'=>'Something went wrong']);
        }
        
    }
   
}