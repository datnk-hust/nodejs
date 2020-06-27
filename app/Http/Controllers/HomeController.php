<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Level;
class HomeController extends Controller
{
    //
    public function index()
    {
            return view("login");
    }
    public function postLogin(Request $request)
    {
       $remember = 0;
        if (!empty($request->remember)) 
        {
            $remember = 1;
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
             {
            
                if(Auth::user()->isAdmin())
                {
                    return redirect()->route('get.admin');
                }elseif(Auth::user()->isUser())
                {
                    return redirect()->route('get.home');
                }
                else
                {
                    return redirect()->route('doctor.home');
                }
            }
        else{
                $message = "Đăng nhập thất bại";
                return view('login',compact('message'));
            }
    }

    public function getLogout()
    {
            Auth::logout();
            return view('login');
    }

    //hàm thông báo bảo dưỡng thiết bị
    // public function notify()
    
}
