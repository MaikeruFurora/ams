<?php

namespace App\Http\Controllers;

use App\Models\AssetStatus;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Services\AssetService;
use App\Services\AssetStatusService;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    protected $supplierService;
    protected $assetStatutsService;
    protected $assetService;
    public function __construct(SupplierService $supplierService,AssetStatusService $assetStatutsService)
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
                    $data = AssetStatus::where('name','LIKE',"%$search%")->limit(5)->get(["id","name"]);
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
        return $assetService->store($request);
    }
}
