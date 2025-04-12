<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard/index');
    }

    public function product(){
        return view('Dashboard/product');
    }

}
