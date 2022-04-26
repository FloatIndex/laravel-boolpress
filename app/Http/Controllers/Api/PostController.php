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

        // each funzione delle collection
        $posts->each(function($post) {
            if($post->cover){
                $post->cover = url('storage/' . $post->cover); // url() restituisce l'url completo di qualsiasi file dentro la cartella public (cokme asset() per il backend)
            } else {
                $post->cover = url('img/filling-image.jpg');
            }
        });

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
        // uso first() anziché get() perché per via dell'univocità dello slug sono sicura di trovare
        // al massimo una sola corrispondenza; first restituisce un'istanza, mentre get una collection
        // di istanze e, in questo caso, restituirebbe una collection contenente una sola istanza
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        if($post->cover){
            $post->cover = url('storage/' . $post->cover); // url() restituisce l'url completo di qualsiasi file dentro la cartella public (cokme asset() per il backend)
        } else {
            $post->cover = url('img/filling-image.jpg');
        }

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