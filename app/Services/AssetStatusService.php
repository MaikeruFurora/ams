<?php

namespace App\Services;

use App\Models\AssetStatus;

class AssetStatusService{

    public function store($request){

        if(AssetStatus::updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
        ])){
            return back()->with(['msg'=>'Successfully Saved']);
        }else{
            return back()->with(['msg'=>'Something went wrong']);
        }
        
    }
   
}