<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Asset;
use App\Models\AssetStatus;
use App\Models\Category;
use App\Models\Pullout;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Services\AssetService;
use App\Services\AssetStatusService;
use App\Services\SupplierService;
// use Com\Tecnick\Barcode\Type\Square\QrCode;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller
{

    protected $supplierService;
    protected $assetStatutsService;
    protected $assetService;
    public function __construct(SupplierService $supplierService,AssetStatusService $assetStatutsService, AssetService $assetService)
    {
        $this->supplierService     = $supplierService;
        $this->assetStatutsService = $assetStatutsService;
    }

    public function index(){

        return view('asset.index');

    }

    public function create(){
       
        return view('asset.create',[
            'categories'        => Category::get(['id','name']),
        ]);

    }

    public function edit(Asset $asset){
        $category = Category::get(['id','name']);
        return view('asset.edit',compact('asset','category'));

    }

    public function list(Request $request, AssetService $assetService){

        return  $assetService->list($request);

    }

    public function getSubCategory(Category $category){
        return $category->sub_categories;
    }

    public function autocomplete(Request $request,$type){

        $data = [];
        
        $search = $request->q;
        
        switch ($type) {
            case 'supplier':
                    $data = Supplier::where('name','LIKE',"%$search%")->limit(5)->get(["id","name"]);
                break;
            case 'status':
                    $data = AssetStatus::where('name','LIKE',"%$search%")->limit(7)->get(["id","name"]);
                break;
            case 'category':
                    $data = Category::where('name','LIKE',"%$search%")->limit(5)->get(["id","name"]);
                break;
            default:
                    return [];
                break;
        }

        return response()->json($data);

    }

    public function supplierStore(Request $request){
        
        return $this->supplierService->store($request);

    }

    public function assetStatusStore(Request $request){
        
        return $this->assetStatutsService->store($request);

    }

    public function store(Request $request, AssetService $assetService){
        
        if (!empty($request->qty)) {
            return $assetService->store($request);
        }else{
            return $assetService->updateSave($request);
        }
        
    }

    public function record(Asset $asset){
        
        $assetStatus = AssetStatus::get(['id','code','name']);

        $asset->load(['record','record.asset_status','record.user','accountability:asset_id,control_no']);

        return view('asset.record',compact('asset','assetStatus'));

    }

    public function generate(Request $request){

        $asset = explode(",",$request->asset);

        $assets = Asset::whereIn('id',$asset)->get();

        switch ($request->generate) {
            case 'barcode':
                    return view('print.generate-code-barcode',compact('assets'));
                break;
            case 'qrcode':
                    return view('print.generate-code-qrcode',compact('assets'));
                break;
            
            default:
                    return 'break';
                break;
        }
        
    }

    public function changeStatus(Request $request){

        // return $request;
        $data = Asset::whereId($request->asset)->first();

        return Helper::record($request->asset,$data->asset_status_id,$data->accountability->user_id,$request->remarks);

    }

   
}
