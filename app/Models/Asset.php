<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public $guarded=[];
    
    // public $fillable=[
    //         'sub_category_id' ,
    //         'supplier_id'     ,
    //         'asset_status_id' ,
    //         'item_name'       ,
    //         'asset_code'      ,
    //         'serial_number'   ,
    //         'purchase_order'  ,
    //         'purchase_amount' ,
    //         'actual_amount'   ,
    //         'date_purchase'   ,
    //         'date_recieve'    ,
    //         'description'     ,
    //         'service_warranty',
    //         'product_warranty',
    // ];
}
