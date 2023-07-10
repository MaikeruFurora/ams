<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        
        return view('configure.category.index',[
            'types'=>Type::get(['id','name'])
        ]);
    
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required'
        ]);

        if(Category::updateOrCreate(['id'=>$request->id],[
            'name'   => $request->name,
            'type_id'=> $request->type,
        ])){
            return back()->with(['msg'=>'Successfully Saved']);
        }else{
            return back()->with(['msg'=>'Something went wrong']);
        }

    }

    public function list(Request $request){

        $search = $request->query('search', array('value' => '', 'regex' => false));
        $draw = $request->query('draw', 0);
        $start = $request->query('start', 0);
        $length = $request->query('length', 25);
        $order = $request->query('order', array(1, 'asc'));        
        $filter = $search['value'];
        $query = Category::with(['type:name,id','sub_categories:name,id,category_id']);
        if (!empty($filter)) {  $query->where('categories.name', 'like', '%'.$filter.'%'); }
        $recordsTotal = $query->count();
        $query->take($length)->skip($start);
        $json = array(
            'draw'          => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
        );
        $audit = $query->get();
        foreach ($audit as $value) {
            $json['data'][] = [
                'name'           =>$value->name,
                'sttus'          =>$value->sttus,
                'type'           =>$value->type->name,
                'type_id'        =>$value->type->id,
                'sub_categories' =>$value->sub_categories,
                'id'             =>$value->id
            ];
        }
        return $json;
    }

}
