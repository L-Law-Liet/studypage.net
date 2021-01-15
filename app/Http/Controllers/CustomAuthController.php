<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CustomAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
        }
        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
    }
    public function loginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function loginWithFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function googleRedirect(){
        $user = Socialite::driver('google')->user();
        $u = User::where('email', $user->email)->first();
        if ($u) {
            Auth::login($u);
        }
        else {
            $u = new User();
            $u->name = substr($user->name, 0, strpos($user->name, ' '));
            $u->surname = substr($user->name, strpos($user->name, ' ')+1, strlen($user->name)-1);
            $u->email = $user->email;
            $u->confirmed = 0;
            $u->save();
            Auth::login($u);
        }
        return redirect('/');
    }
    public function facebookRedirect(){
        $user = Socialite::driver('facebook')->user();
        $u = User::where('email', $user->email)->first();
        if ($u) {
            Auth::login($u);
        }
        else {
            $u = new User();
            $u->name = substr($user->name, 0, strpos($user->name, ' '));
            $u->surname = substr($user->name, strpos($user->name, ' ')+1, strlen($user->name)-1);
            $u->email = $user->email;
            $u->confirmed = 0;
            $u->save();
            Auth::login($u);
        }
        return redirect('/');
    }
}
