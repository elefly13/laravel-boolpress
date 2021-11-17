@extends('layouts.app');

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card text-center">
          <div class="card-header">
            POST
          </div>
          <div class="card-body">
            @if ($post->cover)
            <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                
            @endif
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.index')}}" class="btn btn-primary">Torna ai posts</a>
          </div>
          <div class="card-footer text-muted">
            {{ $post->slug }}
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection
