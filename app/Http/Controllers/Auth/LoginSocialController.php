<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;


class LoginSocialController extends Controller
{
    public function redirect_github() {
        return Socialite::driver('github')->redirect();
    }

    public function callback_github() {
        $githubUser = Socialite::driver('github')->user();
        $UserExist = User::where('email','=',$githubUser->email)->get();
        
        $RedSocial = 'Github';

        if(count($UserExist)) {
            $avatar =  $githubUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
        else {
            $user = User::create([
                'name'=>$githubUser->name,
                'email'=>$githubUser->email,
                'avatar'=>$githubUser->avatar,
            ]);
            $avatar = $githubUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
    }

    public function redirect_facebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook() {
        $facebookUser = Socialite::driver('facebook')->user();
        $UserExist = User::where('email','=',$facebookUser->email)->get();
        //dd($googleUser);
        $RedSocial = ' Facebook ';

        if(count($UserExist)) {
            $avatar =  $facebookUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
        else {
            $user = User::create([
                'name'=>$facebookUser->name,
                'email'=>$facebookUser->email,
                'avatar'=>$facebookUser->avatar,
            ]);
            $avatar = $facebookUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
    }

    //Login with google
    public function redirect_google() {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google() {
        $googleUser = Socialite::driver('google')->user();
        
        $UserExist = User::where('email','=',$googleUser->email)->get();
        $RedSocial = ' google ';

        if(count($UserExist)) {
            $avatar =  $googleUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
        else {
            $user = User::create([
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
                'avatar'=>$googleUser->avatar,
            ]);
            $avatar = $googleUser->avatar;

            return view('bienvenida', compact(['avatar','RedSocial']));
        }
    }
}
