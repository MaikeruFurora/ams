<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountability extends Model
{
    use HasFactory;

    protected $guarded=[];

    // public function setControlNoAttribute($value)
    // {
    //     return strtoupper($value->control_no);
    // }

    // public function getControlNoAttribute($value)
    // {
    //     return strtoupper($value->control_no);
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function asset(){
        return $this->belongsTo(Asset::class);
    }

    public function scopeStoreAccount($request){
        return Static::create($this->requestInput($request));
    }

    public function requestInput($request){
        return [
            'control_no' => $request->input('control_no'),
            'asset_id'   => $request->input('asset'),
            'department_id' => $request->input('department'),
            'user_id'    => $request->input('user'),
        ];
    }
}
