<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function getHome()
    {
        $posts = Post::latest()->take(3)->get(); //los 3 posts mas recients
        return view('home', compact('posts'));
    }
}