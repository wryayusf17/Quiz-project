<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ctrl_user extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' =>'required'
        ]);
        if(!$validator->fails()){
            $user = User::where('email',$request->email)->first();
            if(Hash::check($request->password, $user->password)){   
               
        $user->tokens()->delete();
        return redirect('/welcome');
                
            }else{
                return response()->json(['errors'=>['password is incorect']],401);
            }

            
        }else{
            return response()->json(['error'=> $validator->errors()->all()],401);
        }

        
    }

    
    public function reregister(){
        redirect('/reregister');
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users,email',
            'password'=> 'required|min:6'
        ]);

        if(!$validator->fails()){
            $user = User::create([
                'name' => 'empty',
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect('/welcome');
        }else{
            return response()->json(['errors'=>$validator->errors()->all()],401);
        }
    }

    public function logout(Request $request){
        
         $request->user()->tokens()->delete();
         return response()->json(['success'=> 'logged out successfully'],200);
    }




}
