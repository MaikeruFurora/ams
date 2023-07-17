<?php

namespace App\Http\Controllers;

use App\Models\Accountability;
use App\Models\Department;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function  __construct(UserService $userService){
        $this->userService = $userService;
    }

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
            'contact_no' => 'string|min:11|max:11',
            'username'   => 'max:10',//|unique:users,username
            'department' => 'required',
            'job_title'  => 'max:50'
        ]);

        if (User::updateorcreate(['id'=>$request->id],[
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
        
        return $this->userService->list($request);
       
    }

    public function assign(User $user){
        
        return view('user.accountability',compact('user'));

    }


    public function assignedList(Request $request){
        
        return $this->userService->assignedList($request);

    }
    

}
