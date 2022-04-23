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
        //$posts = Post::with(['category'])->get();

        $posts = Post::with(['category', 'tags'])->paginate(2);

        return response()->json(
            [
                'results' => $posts,
                'success' => true // non obbligatorio
            ]
        );
    }
}