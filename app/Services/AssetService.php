<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class AssetService{

    public function store($request){

    $request->validate([
        'sub_category_id.*'  => 'required',
        'supplier_id.*'      => 'required',
        'asset_status_id.*'  => 'required',
        'item_name.*'        => 'required',
        'asset_code.*'       => 'required',
        'serial_number.*'    => 'required',
        'purchase_order.*'   => 'required',
        'purchase_amount.*'  => 'required',
        'actual_amount.*'    => 'required',
        'date_purchase.*'    => 'required',
        'date_recieve.*'     => 'required',
        'description.*'      => 'max:1000',
        // 'service_warranty.*' => 'sometimes',
        // 'product_warranty.*' => 'sometimes',
        // 'brand.*'            => 'sometimes',
        // 'color.*'            => 'somtimes',
        'uom.*'              => 'max:20|min:0',
    ]);

    try {

        DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

            for ($i=0; $i < $request->qty; $i++) { 

                Asset::create([
                    'sub_category_id'  => $request->input('sub_category'),
                    'supplier_id'      => $request->input('supplier')[$i],
                    'asset_status_id'  => $request->input('asset_status')[$i],
                    'item_name'        => $request->input('item_name')[$i],
                    'asset_code'       => $request->input('asset_code')[$i],
                    'serial_number'    => $request->input('serial_number')[$i],
                    'purchase_order'   => $request->input('purchase_order')[$i],
                    'purchase_amount'  => $request->input('purchase_amount')[$i],
                    'actual_amount'    => $request->input('actual_amount')[$i],
                    'date_purchase'    => $request->input('date_purchase')[$i],
                    'date_recieve'     => $request->input('date_recieve')[$i],
                    'description'      => $request->input('description')[$i],
                    'service_warranty' => $request->input('service_warranty')[$i],
                    'product_warranty' => $request->input('product_warranty')[$i],
                    'brand'            => $request->input('brand')[$i],
                    'uom'              => $request->input('uom')[$i],
                    'color'            => $request->input('color')[$i],
                ]);
            }

        DB::commit();

    } catch(\Exception $exp) {

        DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"
    
    }
        
    }
   
}