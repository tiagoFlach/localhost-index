<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard(){
    	return view('pages.dashboard');
    }

    //public function infophp(){
    //	return view('pages.php-info');
    //}
}
