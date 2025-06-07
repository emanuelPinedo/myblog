<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getHome(){
        $query = Post::latest();

        if (Auth::check()) {
            $query->where(function ($q) {
                $q->where('habilitated', true)
                ->orWhere('user_id', Auth::id());
            });
        } else {
            $query->where('habilitated', true);
        }

        $posts = $query->take(3)->get();//los 3 posts más recientes

        return view('home', compact('posts'));
    }
}