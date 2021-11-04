@extends('layouts.dashboard')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('admin.posts.show', $post->slug)}}"></a>{{$post->title}}</li>
            
        @endforeach
    </ul>

    
@endsection