<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect()->to('/login');
        }

        return view('home.index');
    }
}
