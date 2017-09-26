<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{

    public function home()
    {
        return $this->slug('home');
    }
    
    public function login()
    {
        return view('auth.login');
    }

    public function slug($slug)
    {
        if (!View::exists('pages.' . $slug)) {
            return view('errors.404');
        }
        
        return view('pages.' . $slug);
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('/account/profile');
        } else {
            return view('auth.register');
        }
    }

}
