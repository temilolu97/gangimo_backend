<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
class UserController extends Controller
{
    public function signUp(Request $request){
        
        $validatedData = $request ->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);
        $user = User::where('email', $request->email);
        if($user->exists()){
            return response()->json(['message'=>'User already exists']);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $token = $user->createToken($user)->accessToken;
            return response()->json(['message'=>'successfully registered','token'=>$token ],200);
        }   
    }

    public function login(Request $request){
        $credentials= $request->all();

        if(Auth::attempt($credentials)){
            $token = Auth::user()->createToken($request->email)->accessToken;
            return response()->json(['message'=>'successfully logged in','token'=>$token,'username'=>Auth::user()->name],200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'],401);
        }    
    }

    public function logout()
    {   
        if(Auth::check()){
            Auth::logout();
            return response()->json(['message'=>'user logged out successfully'],200);
        }
        else{
            return response()->json(['message'=>'no user signed in currently']);
        }
    }
}
