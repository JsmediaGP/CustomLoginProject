<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class forgetPasswordController extends Controller
{
    public function forgetpasswordView(){
        return view('forgetpassword');

    }
    public function forgetpassword(Request $request){
        $request -> validate( [
            'email'=> 'required|email|exists:users',
        ]);

        //generating token and adding it to the database
        $token  = Str::random(length:64);
 
        DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);

        Mail::send("mails.forgetpasswordmail", ['token'=>$token], function($message) use($request){
            $message->to($request->email);
            $message->subject("RESET YOUR PASSWORD");

        });
        return redirect()->to(route('forgetpasswordview'))->with("message", "Kindly check your email address to proceed");

    }

    public function resetpasswordview($token){

        return view('resetpassword', compact('token'));
    }

    public function resetpassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=>'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            //'cpassword'=>'required|confirmed'
        ]);
        if(!$request){
            return Redirect::back()->withErrors($request);
        }else{
            $passwordupdate = DB::table('password_reset_tokens')->where([
                "email"=>$request->email,
                "token"=>$request->token ])->first();
            
                if(!$passwordupdate){
                    return redirect()->to(route('forgetpasswordview'))->with("message", "Something went wrong");
                }else{
                    User::where("email", $request->email)->update(["password"=>Hash::make($request->password)]);
                
                    //delete reset token data from db
                    DB::table('password_reset_tokens')->where(["email"=>$request->email])->delete();
        
                    return redirect('/login')->with("message", "Password Reset Successful");

                }
               

        }
        
 
    } 
}
