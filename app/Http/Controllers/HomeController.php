<?php

namespace App\Http\Controllers;

use App\category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $categories = category::all();
        $posts =Post::latest()->approved()->published()->take(6)->get();
        
        return view('welcome',compact('posts','categories'));
    }
}
