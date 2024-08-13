<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tes extends Controller
{
    public function index()
    {
    //    echo Auth::id();
       echo time();
    }

}
