<?php

namespace App\Http\Controllers;

use App\Models\Image;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $images = Image::OrderBy('id','desc')->paginate(5);
        return view('home.dash', compact('images'));
    }    
}
