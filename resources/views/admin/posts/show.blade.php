@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <h2>{{ $post->title }}</h2>
                <p>{!! $post->content !!}</p>
                <small>Lo slug è: {{ $post->slug }}</small><br>
                @if ($post->category)
                    <small>Categoria di appartenenza: <a href="{{ route('admin.categories.show', $post->category_id)}}">{{ $post->category->name }}</a></small><br>                    
                @else
                    <small>Nessun categoria di appartenenza</small>

                @endif
                <a href="{{ route('admin.posts.index')}}"
                    class="btn btn-info">
                    Torna ai posts
                </a>
            </div>
        </div>
    </div>
    
@endsection