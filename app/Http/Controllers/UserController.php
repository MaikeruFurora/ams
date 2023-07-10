<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        return view('user.index');

    }

    public function create(){

        return view('user.create',[
            'departments'=>Department::get(['id','name'])
        ]);

    }
    
    public function edit(User $user){

        return view('user.create',[
            'user'       => $user,
            'departments'=> Department::get(['id','name'])
        ]);

    }

    public function store(Request $request){

        $request->validate([
            'name'       => 'required|max:50',
            // 'email'      => 'max:30|unique:users,email,'.$request->id,
            'contact_no' => 'max:12',
            'username'   => 'max:10|unique:users,username',
            'department' => 'required',
            'job_title'  => 'max:50'
        ]);

        if (User::updateorcreate([
            'name'          => $request->name,
            'email'         => $request->email,
            'contact_no'    => $request->contact_no,
            'username'      => $request->username,
            'department_id' => $request->department,
            'job_title'     => $request->job_title
        ])) {
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
        $query = User::select('users.name','users.id','username','departments.name as dep_name','contact_no','job_title','department_id')->leftjoin('departments','users.department_id','departments.id');
        if (!empty($filter)) {  
            $query->where('name', 'like', '%'.$filter.'%');
            $query->where('departments.name', 'like', '%'.$filter.'%');
            $query->where('contact_no', 'like', '%'.$filter.'%');
            $query->where('job_title', 'like', '%'.$filter.'%');
            $query->where('username', 'like', '%'.$filter.'%');
        }
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
                'name'      => $value->name,
                'username'  => $value->username,
                'email'     => $value->email,
                'dep_name'  => $value->dep_name,
                'contact_no'=> $value->contact_no,
                'job_title' => $value->job_title,
                'id'        => $value->id
            ];
        }
        return $json;
    }
    

}
