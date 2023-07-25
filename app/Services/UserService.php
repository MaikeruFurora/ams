<?php

namespace App\Services;

use App\Helper\Helper;
use App\Models\Accountability;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService{
    
  public function list($request){
    $search = $request->query('search', array('value' => '', 'regex' => false));
    $draw = $request->query('draw', 0);
    $start = $request->query('start', 0);
    $length = $request->query('length', 25);
    $order = $request->query('order', array(1, 'asc'));        
    $filter = $search['value'];
    $query = User::select('users.name','users.id','username','departments.name as dep_name','contact_no','job_title','department_id')->leftjoin('departments','users.department_id','departments.id');
    if (!empty($filter)) {  
        $query->where('name', 'like', '%'.$filter.'%');
        $query->where('departments.name', 'like', '%'.$filter.'%');
        $query->where('contact_no', 'like', '%'.$filter.'%');
        $query->where('job_title', 'like', '%'.$filter.'%');
        $query->where('username', 'like', '%'.$filter.'%');
    }
    $recordsTotal = $query->count();
    $query->take($length)->skip($start);
    $json = array(
        'draw' => $draw,
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsTotal,
        'data' => [],
    );
    $audit = $query->get();
    foreach ($audit as $value) {
        $json['data'][] = [
            'name'      => $value->name,
            'username'  => $value->username,
            'email'     => $value->email,
            'dep_name'  => $value->dep_name,
            'contact_no'=> $value->contact_no,
            'job_title' => $value->job_title,
            'id'        => $value->id
        ];
    }
    return $json;
  }


  public function assignedList($request){
      $search = $request->query('search', array('value' => '', 'regex' => false));
      $draw   = $request->query('draw', 0);
      $start  = $request->query('start', 0);
      $length = $request->query('length', 25);
      $order  = $request->query('order', array(1, 'asc'));        
      $filter = $search['value'];
      $query  = Accountability::with(['asset','asset.asset_status'])->where('user_id',$request->user );
      if (!empty($filter)) {  
          $query->where('asset.item_name', 'like', '%'.$filter.'%');
      }
      $recordsTotal = $query->count();
      $query->take($length)->skip($start);
      $json = array(
          'draw' => $draw,
          'recordsTotal' => $recordsTotal,
          'recordsFiltered' => $recordsTotal,
          'data' => [],
      );
      $audit = $query->get();
      foreach ($audit as $value) {
          $json['data'][] = [
              'control_no'    => $value->control_no,
              'asset_code'    => $value->asset->asset_code,
              'serial_no'     => $value->asset->serial_no,
              'product_no'    => $value->asset->product_no,
              'brand'         => $value->asset->brand,
              'item_name'     => $value->asset->item_name,
              'issued_at'     => $value->issued_at,
              'id'            => $value->id,
              'asset_id'      => $value->asset->id,
              'user_id'       => $value->user_id,
              'status_id'     => $value->asset->asset_status->id,
              'status_code'   => $value->asset->asset_status->code,
              'status'        => $value->asset->asset_status->name
          ];
      }
      return $json;
  }

}