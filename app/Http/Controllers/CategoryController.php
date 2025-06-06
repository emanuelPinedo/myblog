<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getIndex(){
    $posts = Post::paginate(3);
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
            'poster' => 'required|url',

            'content' => 'required|string',
        ]);

        //craer post
        $post = new Post();
        $post->title = $request->input('title');
        $post->poster = $request->input('poster');
        $post->content = $request->input('content');
        $post->habilitated = $request->has('habilitated');//true si se marca el checkbox
        $post->user_id = Auth::id();

        $post->save();

        //redirigir a posts
        return redirect('category')->with('success', 'Post creado correctamente.');
    }

    public function postUpdate(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => ['required', 'url', 'regex:/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i'],
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'No autorizado para editar este post.');
        }

        $post->title = $request->input('title');
        $post->poster = $request->input('poster');
        $post->content = $request->input('content');
        $post->habilitated = $request->has('habilitated');

        $post->save();

        return redirect('category')->with('success', 'Post actualizado correctamente.');
    }

    public function getCreate(){
        return view('category.create');
    }

    public function getEdit($id){
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'No autorizado para editar este post.');
        }

        return view('category.edit', ['post' => $post]);
    }

}