<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts as Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(8);
        return view('home', compact('posts'));
    }
    public function show($id)
    {
        $posts = Post::findOrFail($id);
        return view('layouts.blog', compact('posts'));
    }
    public function api()
    {
        return view('api');
    }


}
