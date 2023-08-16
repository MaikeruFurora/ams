<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulloutDetail extends Model
{
    use HasFactory;

    protected $guarded=[];

    
    public function asset(){

        return $this->belongsTo(Asset::class);

    }

    public function pullout(){

        return $this->belongsTo(Pullout::class);

    }

    public function scopeStore($q,$request){

        return Static::create($this->requestInput($request));

    }

    public function requestInput($request){
        return [
            'asset_id'      =>$request->asset_id,
            'status'        =>$request->status,
        ];
    }

}
