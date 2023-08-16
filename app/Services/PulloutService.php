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
        $query = Pullout::with(['pullout_detail','pullout_detail.asset','pullout_detail.asset.asset_status']);
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
                'id'             => $value->id,
                'pullout_no'     => $value->pullout_no,
                'date_recieved'  => !empty($value->date_recieved)?date("m/d/Y",strtotime($value->date_recieved)):'',
                'pullout_detail' => $value->pullout_detail,
                'created_at'     => $value->created_at->format("m/d/Y"),
                'remarks'        => $value->remarks,
            ];
        }
        return $json;
    }

}