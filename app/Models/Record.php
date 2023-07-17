<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public $guarded=[];


    public function asset(){
        return $this->belongsTo(Asset::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function asset_status(){
        return $this->belongsTo(AssetStatus::class);
    }

}
