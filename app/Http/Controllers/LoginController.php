<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->is_pegawai == 1){
                activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'pegawai', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_pegawai_login');
            }
            elseif(Auth::user()->is_admin == 1){
                activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'admin', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_admin_login');
            }
            elseif(Auth::user()->is_atasan1 == 1 || Auth::user()->is_atasan2 == 1){
                activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'atasan', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_atasan_login');
            }
            elseif(Auth::user()->is_driver == 1){
                activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'driver', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_driver_login');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request){
        if(Auth::user()->is_pegawai == 1){
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'pegawai', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_pegawai_logout');
        }
        elseif(Auth::user()->is_admin == 1){
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'admin', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_admin_logout');
        }
        elseif(Auth::user()->is_atasan == 1){
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'atasan', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_atasan_logout');
        }
        elseif(Auth::user()->is_driver == 1){
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'driver', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_driver_logout');
        }
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $this->middleware('guest')->except('logout');
        return redirect('/');
    }

}
