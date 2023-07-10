<?php

namespace App\Services;

use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;

class AuthService{
    
    public function login($request){
        
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([

            $fieldType => $request->input('username')

        ]);
        
        $remember = $request->input('remember_token');

        $credentials = $request->only($fieldType, 'password');

        return $this->userRoute(

            $credentials,

            $remember,

            ['_token','_method'],

            ['msg'=>'Please try again','action'=>'warning']
        );

    }

    public function userRoute($credentials,$remember,$data,$errorM){


        if (Auth::guard('web')->attempt($credentials,$remember)) {
           
            Helper::auditLog('Logged In','Logged In');

            return redirect()->route('authorize.index');

        }else{
            
            return back()->with($errorM);

        }

    }

    public function signOut(){

        if (Auth::guard('web')->check()) {

            Helper::auditLog('Logged In','Logged Out');

            Auth::guard('web')->logout();

            return redirect()->route('auth.login');

        }

    }

}