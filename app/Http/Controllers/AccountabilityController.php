<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Accountability;
use PDF;
use Illuminate\Http\Request;

class AccountabilityController extends Controller
{
    public function store(Request $request){
    
        $assets = explode(",",$request->asset);

       if (is_array($assets)) {

            $data = array();

            for ($i=0; $i < count($assets); $i++) { 
                $data[] = Accountability::create([
                    'asset_id'      => $assets[$i],
                    'user_id'       => $request->input('user'),
                    'department_id' => $request->input('department'),
                    'control_no'    => $request->input('control_no'),
                    'issued_at'     => $request->input('issued_at'),
                ]);

                Helper::record($data[$i]->asset_id,$data[$i]->asset->asset_status->id,$data[$i]->user_id,'The item was successfully assigned to '.$data[$i]->user->name);
            }
            
       }else{

           $data =  Accountability::storeAccount($request);

           Helper::record($data->id,$data->asset_status_id,$data->user_id,'The item was successfully assigned to '.$data->user->name);

           return $data;

       }

    }

    public function print($controlNo){

        // return $accountability;

        //  $dompdf =  PDF::loadView('print/accountability-form');

        //  return $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        
        $accountability = Accountability::where('control_no',$controlNo)->first();

    //    return $accountability->user;

        $asset  = Accountability::where('control_no',$controlNo)->get();
        
        return view('print.accountability-form',compact('asset','accountability'));

    }
}
