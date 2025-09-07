<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProfileController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
         return [ new Middleware('role:admin')];
    }
    
    public function index(){
        return view('sistem.profile.index');
    }
}
