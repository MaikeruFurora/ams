<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        
        return view('configure.department.index');
    
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required'
        ]);

        if(Department::updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name, 
            'head_id'=>$request->head_id, 
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
        $query = Department::select('users.name as head','departments.name','sttus','departments.id')->leftjoin('users','departments.head_id','users.id');
        if (!empty($filter)) {  $query->where('name', 'like', '%'.$filter.'%'); }
        $recordsTotal = $query->count();
        $query->take($length)->skip($start);
        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
        );
        $audit = $query->get();
        foreach ($audit as $value) {
            $json['data'][] = [
                'name' =>$value->name,
                'head' =>$value->head,
                'id'   =>$value->id
            ];
        }
        return $json;
    }

}
