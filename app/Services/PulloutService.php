<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\Pullout;
use Illuminate\Support\Facades\Auth;

class PulloutService{


    public function list($request){
        $search = $request->query('search', array('value' => '', 'regex' => false));
        $draw = $request->query('draw', 0);
        $start = $request->query('start', 0);
        $length = $request->query('length', 25);
        $order = $request->query('order', array(1, 'asc'));        
        $filter = $search['value'];
        $query = Pullout::with(['asset','asset.asset_status']);
        if (!empty($filter)) {  
            $query->where('asset.item_name', 'like', '%'.$filter.'%'); 
            $query->where('pullout_no', 'like', '%'.$filter.'%'); 
            $query->where('date_recieve', 'like', '%'.$filter.'%'); 
            $query->where('date_return', 'like', '%'.$filter.'%'); 
        }
        $recordsTotal = $query->count();
        $query->take($length)->skip($start);
        $json = array(
            'draw'          => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
        );
        $audit = $query->get();
        foreach ($audit as $value) {
            $json['data'][] = [
                'id'           => $value->id,
                'pullout_no'   => $value->pullout_no,
                'date_recieved'=> $value->date_recieved,
                'date_return'  => $value->date_return,
                'item_name'    => $value->asset->item_name,
                'asset_code'   => $value->asset->asset_code,
                'remarks'      => $value->remarks,
            ];
        }
        return $json;
    }

}