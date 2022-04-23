<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // poiché i post contengono come unica informazione legata alle categories il category_id,
        // e nella vista index vado a richiedere category->name, con la semplice sintassi
        // $posts = Post::all(); costringo laravel a fare una query per ogni post per interrogare il DB
        // sul name della categoria associata. Con la sintassi sotto invece faccio un'unica query, cioè una
        // unica interrogazione al server che contiene tutti i dati necessari (cioè compresi category e tag) 
        // con un grandissimo incremento delle prestazioni
        // N.B: with prende come argomento il nome del metodo che definisce la relazione tra entità (vedi model Post)
        $posts = Post::with(['category', 'tags'])->get();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'content' => 'required|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();

        // creazione slug
        $slug = Str::slug($data['title']); //sintassi da documentazione: $slug = Str::of($data['title'])->slug('-');
        // verifica unicità slug
        $counter = 1;
        while(Post::where('slug', $slug)->first()) {
            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        $post = new Post();
        $post->fill($data);
        $post->save();
        $post->tags()->sync($data['tags']);
        
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $now = Carbon::now();
        $postDateTime = Carbon::create($post->created_at);
        $diffInDays = $now->diffInDays($postDateTime);

        return view('admin.post.show', compact('post', 'diffInDays'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:2',
            'content' => 'required|min:10',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();

        // creazione slug
        $slug = Str::slug($data['title']); //sintassi da documentazione: $slug = Str::of($data['title'])->slug('-');

        if($post->slug != $slug) {
            // verifica unicità slug
            $counter = 1;
            while(Post::where('slug', $slug)->first()) {
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }

        $post->update($data);
        $post->save();
        
        $post->tags()->sync($data['tags']);
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
