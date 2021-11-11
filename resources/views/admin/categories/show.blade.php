@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione categoria {{ $category->id }}</h1>
                <h2>{{ $category->name }}</h2>
               
                <small>Lo slug è: {{ $category->slug }}</small><br>
                <a href="{{ route('admin.categories.index')}}"
                    class="btn btn-info">
                    Torna alle categorie
                </a>
            </div>
            <div class="col-12 m-5">
                <h2>Lista di post collegati alla categoria</h2>
                <ul>
                    @forelse ($category->posts as $post)
                        <li><a href="{{ route('admin.posts.show', $post->slug)}}">{{ $post->title}}</a></li>
                    @empty
                        <p>Nessun post collegato</p>
                        
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    
@endsection