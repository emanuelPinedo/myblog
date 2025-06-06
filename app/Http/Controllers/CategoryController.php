<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getIndex(Request $request){
        $query = Post::query();

        //filtrar posts
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        //mostrar los posts habiliotados o loos del user logeado
        $query->where(function ($q) {
            $q->where('habilitated', true);
            
            //user logeado, mostarle sus posts no habilitados
            if (Auth::check()) {
                $q->orWhere('user_id', Auth::id());
            }
        });

        $posts = $query->paginate(3);

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

    public function destroy($id){
        $post = Post::findOrFail($id);

        //solo puede borrarlo el user que lo creo
        if ($post->user_id !== Auth::id()) {
            abort(403);//errro de laravel q prohibe y detiene la ejecucion si n es un user autorizado
        }

        $post->delete();

        return redirect('category')->with('error', 'Post eliminado correctamente.');
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