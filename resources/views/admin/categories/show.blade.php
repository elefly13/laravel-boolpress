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
                    Torna ai posts
                </a>
            </div>
            <div class="col-12">
                <h2>Lista di post collegati alla categoria</h2>
                <ul>
                    @foreach ($category->posts as $post)
                        <li><a href="{{ route('admin.posts.show', $post->id)}}">{{ $post->title}}</a></li>
                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
@endsection