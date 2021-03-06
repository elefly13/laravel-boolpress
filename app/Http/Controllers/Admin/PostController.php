<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
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

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dei dati che arrivano dal form 
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags'=>'exists:tags,id',
            'image'=>'nullable|image'

        ]);

        $form_data = $request->all();

        // mi posiziono prima del fill e
         // verifico se è stata caricata una immagine 
         if(array_key_exists('image', $form_data)) {
            // salviamo l'immagine e recuperiamo il path
            $cover_path = Storage::put('post_covers', $form_data['image']);

            // aggiungiamo all'array che viene usato nella funzione fill che è il nostro form_data
            // la chiave cover che contiene il percorso relativo dall'immagine caricata a partire da public/storage 
            $form_data['cover'] = $cover_path;

        }

        $new_post = new Post();
        $new_post->fill($form_data);

        $slug = Str::slug($new_post->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente) {
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }
        $new_post->slug = $slug;

        $new_post->save();

        $new_post->tags()->attach($form_data['tags']);

        return redirect()->route('admin.posts.index')->with('status', 'Il post è stato correttamente salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        if(!$post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        // Validazione dei dati che arrivano dal form 
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags'=>'exists:tags,id',
            'image'=>'nullable'|'image'
        ]);
        
        $form_data = $request->all();
        // verifico che il titolo del form è diverso dal vecchio titolo 
        if($form_data['title'] != $post->title) {
            // se entriamo qua è stto modificato il titolo 
            
            $slug = Str::slug($form_data['title'], '-');

            $slug_presente = Post::where('slug', $slug)->first();
    
            $contatore = 1;
            while($slug_presente) {
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            } 
            $form_data['slug'] = $slug;
        }
        // verifico se è stata caricata un immagine 
        if (array_key_exists('image', $form_data)) {
            // prima di aggiornare elimito la vecchia immagine 
            // salvo l'immagine e recupero il path 
            Storage::delete($post->cover);
            $cover_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $cover_path;
        }
        $post->update($form_data);

        if(array_key_exists('tags', $form_data)) {
            $post->tags()->sync($form_data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }
        

        return redirect()->route('admin.posts.index')->with('status', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eliminato');
    }
}
