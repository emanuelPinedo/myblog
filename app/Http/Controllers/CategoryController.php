<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getIndex(){
    $posts = Post::all(); // trae todos los posts de la base de datos
    return view('category.index', ['posts' => $posts]);
    }

    public function getShow($id){
        $post = Post::findOrFail($id);
        return view('category.show', ['post' => $post]);
    }

    public function postStore(Request $request){
        //validacion
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|string|max:255',

            'content' => 'required|string',
        ]);

        //craer post
        $post = new Post();
        $post->title = $request->input('title');
        $post->poster = $request->input('poster');
        $post->content = $request->input('content');
        $post->habilitated = $request->has('habilitated');//true si se marca el checkbox
        $post->save();

        //redirigir a posts
        return redirect('category')->with('success', 'Post creado correctamente.');
    }

    public function getCreate(){
        return view('category.create');
    }

    public function getEdit($id){
        $post = Post::findOrFail($id);
        return view('category.edit', ['post' => $post]);
    }

}