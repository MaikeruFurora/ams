<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pullout extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function asset(){

        return $this->belongsTo(Asset::class);

    }

    public function scopeStore($q,$request){

        $request->request->add(

            ['pullout_no'=> $this->setPrefixSeries()

        ]);

        return Static::create($this->requestInput($request));

    }

    public function requestInput($request){
        return [
            'pullout_no'    =>$request->pullout_no,
            'asset_id'      =>$request->asset,
            'remarks'       =>$request->remarks,
            'date_return'   =>$request->date_return,
            'date_recieved' =>$request->date_recieved,
        ];
    }

    function setPrefixSeries(){

        $res = Static::orderBy('id', 'DESC')->whereDate('created_at',Carbon::now())->first();

        if (!is_null($res)) {
            $iterate = (strtotime(date("Ymd",strtotime($res->created_at)))==strtotime(date("Ymd"))) ? (intval(Static::whereDate('created_at',Carbon::now())->count())+1) : 1;
        }else{
            $iterate = 1;
        }

        $series = 'POUT'.date("y").'-'.date("md").sprintf('%02s', $iterate);

        return $series;

    }
}
