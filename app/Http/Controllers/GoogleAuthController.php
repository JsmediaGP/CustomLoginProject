<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        
        try {
     
            $google_user = Socialite::driver('google')->user();
      
            $finduser = User::where('google_id', $google_user->getId())->first();
      
            if($finduser){
      
                Auth::login($finduser);
     
                return redirect()->intended('home');
      
            }else{
                $newUser = User::create([
                    'name'=>$google_user->getName(),
                    'email'=>$google_user->getEmail(),
                    'google_id'=>$google_user->getId(),
                  
                ]);
     
                Auth::login($newUser);
      
                return redirect()->intended('home');
            }
     
        } catch (Exception $e) {
            dd('something went wrong'.$th->getMessage());
        }
    
    }
}
