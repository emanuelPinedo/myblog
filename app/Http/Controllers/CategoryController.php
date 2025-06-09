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
        if ($request->filled('search')) {//verificar q no este vacio
            $search = $request->input('search');//guardar busqueda
            $query->where(function ($q) use ($search) {//buscar coincidencias
                $q->where('title', 'like', "%{$search}%")//buscar por titulo
                ->orWhere('content', 'like', "%{$search}%");//buscar por contenido
            });
        }

        //mostrar los posts habiliotados o los creados por user logeado
        if (Auth::check()) {
            $query->where(function ($q) {
                $q->where('habilitated', true)
                    ->orWhere('user_id', Auth::id());
            });
            //no esta logeado, mostrar los habilitados en gral
        } else {
            $query->where('habilitated', true);
        }
    
        //mostrar los ultimos 3 posts subidos
        $posts = $query->paginate(3);

        return view('category.index', ['posts' => $posts]);
    }

    public function getShow($id){
        $post = Post::findOrFail($id);

        //post no habilitado y este user no lo subió
        if (!$post->habilitated && $post->user_id !== Auth::id()) {
            abort(403, 'Volá de acá flaco, no podes ver esto');
        }

        return view('category.show', ['post' => $post]);
    }

    public function postStore(Request $request){
        //validacion
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => [
                'required',
                'url',
                'regex:/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i'
            ],
            'content' => 'required|string',
        ], [
            //mensaje de error personalizado para el campo poster
            'poster.regex' => 'La URL debe ser una imagen válida (.jpg, .jpeg, .png, .gif o .webp).',
        ]);

        //craer post
        $post = new Post();
        $post->title = $request->input('title');
        $post->poster = $request->input('poster');
        $post->content = $request->input('content');
        $post->habilitated = $request->has('habilitated');
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

    public function getUserPosts(){
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('dashboard', ['posts' => $posts]);
    }

    public function updateHabilitated(Request $request, $id){
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'No autorizado.');
        }

        $post->habilitated = $request->has('habilitated');
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post actualizado');
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