@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-header">
                        <h1>Visualizzazione post {{ $post->id }}</h1>
                    </div>
                    <div class="card-body">
                        @if ($post->cover)
                        <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                            
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        @if ($post->category)
                            <small>Categoria di appartenenza: <a href="{{ route('admin.categories.show', $post->category_id)}}">{{ $post->category->name }}</a></small><br>                    
                        @else
                            <small>Nessun categoria di appartenenza</small><br>
                        @endif

                        @if($post->tags)
                            @foreach ($post->tags as $tag)
                                @if ($loop->last)
                                    {{ $tag->name }}
                                @else
                                    {{ $tag->name . ',' }}
                                @endif        
                            @endforeach   
                        @endif
                        <br>
                        <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Torna ai posts</a>
                    </div>
                    <div class="card-footer text-muted">
                      {{ $post->slug }}
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
@endsection