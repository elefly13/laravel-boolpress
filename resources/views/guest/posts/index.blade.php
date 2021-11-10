@extends('layouts.app');

@section('content')


     <ul>
        @foreach ($post as $post)
            <li><a href="{{ route('posts.show', $post->slug)}}">{{ $post->title }}</a></li>
            
       @endforeach
    </ul>
    
@endsection
