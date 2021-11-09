<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('admin.posts.create');
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
        // $request->validate([
        //     'title' -> 'required|max:255'
        //     'content' -> 'required'
        // ]);
        $form_data = $request->all();
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

        return redirect()->route('admin.posts.index')->with('inserted', 'Il post è stato correttamente salvato');
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
        if(!$post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post'));
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
        $post->update($form_data);
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
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eliminato');
    }
}
