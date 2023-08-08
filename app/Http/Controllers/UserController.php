<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registration(){
        return view('register');
        //this will show the reistration page
    }

    public function register(Request $request){
        //function to save the reisteration form
        //let's accept users input and validate them using validator function

        $credentials = Validator::make($request->all(), [
            'name'=> 'required|string|max:220',
            'email'=> 'required|email|max:200|unique:users',
            'phone'=> 'required|digits:11|unique:users',
            'password'=>'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);
        //checking if the user fill the right thing
        if($credentials->fails()){
            return Redirect::back()->withErrors($credentials);
          
        }else{
            $users = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password)
            ]);
            if($users){
               // return back()->with('success', 'Register successfully');
                return redirect('/login')->withSuccess('Registeration Successful');
            }
            else{
                return back()->with('message', 'Something Went Wrong');

            }
        }

    }
    public function login(){
        return view('login');
    }
    public function signin(Request $request){
        $request -> validate( [
            'email'=> 'required',
            'password'=> 'required',
        ]);
        // $input->validate([
        //     'email'=> 'required|email',
        //     'password'=>'required'
        // ]);
        if(!$request){
            return Redirect::back()->withErrors($request);
            //return back()->with('message', $input->messages());
        }else{
            $details = $request->only('email', 'password');

                if(Auth::attempt($details)){
                   // $user = Auth::user();
                   return redirect('/home')->withSuccess('message', 'Login Success');
                   
                    
                }else{
                    return back()->with('message', 'Invalid Login Details');
                                       
                }


        }

    }

    public function logout(){
        Auth::logout();
 
        return redirect()->route('login');
    }
}
