@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <h2>{{ $post->title }}</h2>
                <p>{!! $post->content !!}</p>
                <small>Lo slug è: {{ $post->slug }}</small><br>
                <a href="{{ route('admin.posts.index')}}"
                    class="btn btn-info">
                    Torna ai posts
                </a>
            </div>
        </div>
    </div>
    
@endsection