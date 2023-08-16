<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Asset;
use App\Models\Pullout;
use App\Models\PulloutDetail;
use App\Services\PulloutService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PulloutController extends Controller
{

    protected $pulloutService;
    public function __construct(PulloutService $pulloutService)
    {
        $this->pulloutService = $pulloutService;
    }

    public function index(){

        return view('pullout.index');

    }

    public function list(Request $request){

        return $this->pulloutService->list($request);

    }

    public function store(Request $request){

        // Asset::whereId($request->asset)->update(['asset_status_id'=>$request->status]);
        
        $pullout = Pullout::store($request);

        
        foreach ($request->asset as $key => $value) {
            PulloutDetail::create([
                'pullout_id'     => $pullout->id,
                'asset_id'       => $value,
                'pullout_status' => '',
            ]);
        }

        return $pullout->id;
        return Helper::record($request->asset,$request->status,$request->user,$request->remarks);

    }

    public function recieve(Request $request){

        $date = Carbon::now();

        $pullout = Pullout::find($request->id);

        if ($pullout) {
            $res =  $pullout->update(['date_recieved'=>$date]);
        //    if ($res) {
        //     return Helper::record($pullout->asset->id,$pullout->asset->asset_status_id,null,'Pullout Recieved at'. $date);
        //    }
        }else{
            return abort(400);
        }

    }

    public function pulloutForm(Pullout $pullout){

        return view('print.pullout-form',compact('pullout'));

    }
}
