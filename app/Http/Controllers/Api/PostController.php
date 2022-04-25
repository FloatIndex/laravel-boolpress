<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // con questa sintassi richiediamo tutti i dati delle categorie (id, name, slug, created_at, updated_at)
        // in modo che vengano aggiunti al file json, che altrimenti conterrebbe solo il category_id
        // consente di chiedere in un'unica query tutte le informazioni necessarie al display dei post
        // $posts = Post::with(['category'])->get();

        $posts = Post::with(['category', 'tags'])->paginate(2);

        return response()->json(
            [
                'results' => $posts,
                'success' => true // non obbligatorio, standard corso boolean
            ]
        );
    }

    // l'argomento della funzione $slug ha (deve avere) lo stesso nome del parametro variabile della rotta
    // Route::get('/posts/{slug}', 'Api\PostController@show'); definita in api.php
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

        // devo gestire il caso in cui l'utente richieda un URI posts/{slug-non-esistente} e quindi la query restituisca null
        if($post) {
            return response()->json(
                [
                    'results' => $post,
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'results' => 'No result ',
                    'success' => false
                ]
            );
        }
    }
}