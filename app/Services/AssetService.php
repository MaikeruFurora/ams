<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\Accountability;
use App\Models\Asset;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class AssetService{
    

    public function store($request){

        // return $request;

        $request->validate([
            'sub_category.*'     => 'required',
            'supplier.*'         => 'required',
            'asset_status.*'     => 'required',
            'item_name.*'        => 'required',
            'asset_code.*'       => 'required',
            'serial_no.*'        => 'required',
            'product_no.*'       => 'required',
            'purchase_order.*'   => 'required',
            'purchase_amount.*'  => 'required',
            'actual_amount.*'    => 'required',
            'date_purchase.*'    => 'required',
            'date_recieve.*'     => 'required|after:date_purchase.*',
            'description.*'      => 'max:1000',
            // 'service_warranty.*' => '',
            // 'product_warranty.*' => '',
            // 'brand.*'            => '',
            // 'color.*'            => '',
            'uom.*'              => 'max:20|min:0',
        ]);

       

        try {

          
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

                $data = array();

                for ($i=0; $i < intval($request->qty); $i++) { 
    
                    $data[] = Asset::create([
                        'sub_category_id'  => $request->input('sub_category'),
                        'supplier_id'      => $request->input('supplier')[$i],
                        'asset_status_id'  => $request->input('asset_status')[$i],
                        'item_name'        => $request->input('item_name')[$i],
                        'asset_code'       => $request->input('asset_code')[$i],
                        'serial_no'        => $request->input('serial_no')[$i],
                        'product_no'       => $request->input('product_no')[$i],
                        'purchase_order'   => $request->input('purchase_order')[$i],
                        'purchase_amount'  => Helper::cleanNumberByFormat($request->input('purchase_amount')[$i]),
                        'actual_amount'    => Helper::cleanNumberByFormat($request->input('actual_amount')[$i]),
                        'date_purchase'    => $request->input('date_purchase')[$i],
                        'date_recieve'     => $request->input('date_recieve')[$i],
                        'description'      => $request->input('description')[$i],
                        'service_warranty' => $request->input('service_warranty')[$i],
                        'product_warranty' => $request->input('product_warranty')[$i],
                        'brand'            => $request->input('brand')[$i],
                        'uom'              => $request->input('uom')[$i],
                        'color'            => $request->input('color')[$i],
                    ]);

                    Helper::record($data[$i]->id,$data[$i]->asset_status_id,null,'The new item was successfully added.');

                }

            DB::commit();

        } catch(\Exception $exp) {

            DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"
        
        }
    }

    public function updateSave($request){

        $request->validate([
            'sub_category'     => 'required',
            'supplier'         => 'required',
            'asset_status'     => 'required',
            'item_name'        => 'required',
            'asset_code'       => 'required',
            'serial_no'        => 'required',
            'product_no'       => 'required',
            'purchase_order'   => 'required',
            'purchase_amount'  => 'required',
            'actual_amount'    => 'required',
            'date_purchase'    => 'required',
            'date_recieve'     => 'required',
            'description'      => 'max:1000',
            'uom'              => 'max:20|min:0',
        ]);

        // return $request;

        // return  Asset::updateAsset($request);
        
         $res = Asset::updateAsset($request);

        if ($res) {
            return redirect()->route('authorize.asset');
        }
    }
    

    public function list($request){
        
        $search = $request->query('search', array('value' => '', 'regex' => false));
        $draw = $request->query('draw', 0);
        $start = $request->query('start', 0);
        $length = $request->query('length', 25);
        $order = $request->query('order', array(1, 'asc'));
    
        $filter = $search['value'];
    
        // $sortColumns = array('companyname','companies.acronym','bankName','branchName','accountNo');
    
        $query = Asset::with(['asset_status:id,name','sub_category:id,name,category_id','sub_category.category:id,name']);

        if (!empty($request->user)) {
            // $asset = Accountability::where('user_id',$request->user)->get(['asset_id'])->pluck(['asset_id']);
            // $query->whereNotIn('id',$asset);
            $asset = Accountability::get(['asset_id'])->pluck(['asset_id']);
            $query->whereNotIn('id',$asset);
        }

        

        if (!empty($filter)) {
            $query
            ->orwhere('asset_code', 'like', '%'.$filter.'%')
            ->orwhere('item_name', 'like', '%'.$filter.'%')
            ->orwhere('description', 'like', '%'.$filter.'%');
        }
        
    
        $recordsTotal = $query->count();
    
        // $sortColumnName = $sortColumns[$order[0]['column']];
    
        $query->take($length)->skip($start);

    
        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
        );
    
        $products = $query->get();

        foreach ($products as $value) {
           
                $json['data'][] = [
                    'id'                => $value->id,
                    'item_name'         => $value->item_name,
                    'asset_code'        => $value->asset_code,
                    'serial_no'         => $value->serial_no,
                    'purchase_order'    => $value->purchase_order,
                    'purchase_amount'   => $value->purchase_amount,
                    'actual_amount'     => $value->actual_amount,
                    'date_purchase'     => $value->date_purchase,
                    'date_recieve'      => $value->date_recieve,
                    'description'       => $value->description,
                    'category'          => $value->sub_category->category->name,
                    'sub_category'      => $value->sub_category->name,
                    'asset_status'      => $value->asset_status->name,
                ];
        }

        return $json;

    }
   
}