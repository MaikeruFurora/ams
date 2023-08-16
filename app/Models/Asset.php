<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $casts=[
        'actual_amount'  =>'double',
        'purchase_amount'=>'double',
    ];

    public $guarded=[];

    public function pullout_detail(){
        return $this->hasMany(PulloutDetail::class);
    }

    // protected $fillable=[
        //     'sub_category_id',
        //     'asset_status_id',
        //     'supplier_id',
        //     'item_name',
        //     'asset_code',
        //     'serial_number',
        //     'product_number',
        //     'purchase_order',
        //     'purchase_amount',
        //     'actual_amount',
        //     'date_purchase',
        //     'date_recieve',
        //     'description',
        //     'service_warranty',
        //     'product_warranty',
        //     'brand',
        //     'uom',
    //     'color',
    // ];


    public function requestInput($request){
        return [
            'sub_category_id'  => $request->input('sub_category'),
            'supplier_id'      => $request->input('supplier'),
            'asset_status_id'  => $request->input('asset_status'),
            'item_name'        => $request->input('item_name'),
            'asset_code'       => $request->input('asset_code'),
            'serial_no'        => $request->input('serial_no'),
            'product_no'       => $request->input('product_no'),
            'purchase_order'   => $request->input('purchase_order'),
            'product_no'       => $request->input('product_no'),
            'actual_amount'    => Helper::cleanNumberByFormat($request->input('actual_amount')),
            'purchase_amount'  => Helper::cleanNumberByFormat($request->input('purchase_amount')),
            'date_purchase'    => $request->input('date_purchase'),
            'date_recieve'     => $request->input('date_recieve'),
            'description'      => $request->input('description'),
            'service_warranty' => $request->input('service_warranty'),
            'product_warranty' => $request->input('product_warranty'),
            'brand'            => $request->input('brand'),
            'uom'              => $request->input('uom'),
            'color'            => $request->input('color'),
        ];
    }
    

    public function scopeUpdateAsset($q,$request){
        return Static::whereId($request->id)->update($this->requestInput($request));
    }

    public function asset_status(){
        return $this->belongsTo(AssetStatus::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

     public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }

    public function record(){
        return $this->hasMany(Record::class);
    }

    public function accountability(){
        return $this->hasMany(Accountability::class);
    }
}
