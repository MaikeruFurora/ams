<?php

namespace App\Http\Controllers;

use App\Models\AssetStatus;
use App\Models\Pullout;
use App\Models\PulloutDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnAssetController extends Controller
{
    public function index(Pullout $pullout){

        $asset_status = AssetStatus::get(['id','name']);

        if (!empty($pullout->date_recieved)) {
            return view('return.index',compact('pullout','asset_status'));
        }

        return redirect()->route('authorize.pullout');

    }

    public function store(Request $request){

        if (is_array($request->pullout_detail)) {
           foreach ($request->pullout_detail as $key => $value) {
                $data = PulloutDetail::find($value)->update([
                    'return_status'  => $request->return_status[$key],
                    'return_remarks' => $request->return_remarks[$key],
                    'return_date'    => Carbon::now(),
                ]);

                // $data->asset->update()
           }

           return redirect()->route('authorize.pullout');
        }

    }
}
