@extends('layouts.dashboard')

@section('content')
    {{-- <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('admin.posts.show', $post->slug)}}">{{$post->title}}</a></li>
            
        @endforeach
    </ul> --}}

    <div class="content">
        <div class="row">
            <table class="table table-primary table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{$post['id']}}</th>
                            <td>{{$post['title']}}</td>
                            <td>{{$post['slug']}}</td>
                            <td>
                                @if ($post->category)
                                    {{$post->category->name}}
                                @endif
                            </td>
                            <td>
                                @if($post->tags)
                                    @foreach ($post->tags as $tag)
                                        @if ($loop->last)
                                            {{ $tag->name }}
                                        @else
                                            {{ $tag->name . ',' }}
                                        @endif
                                        
                                    @endforeach
                                    
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post->slug)}}"
                                    class="btn btn-info">
                                    Details
                                </a>
                                <a href="{{ route('admin.posts.edit', $post->id)}}"
                                    class="btn btn-light">
                                    Modify
                                </a>
                                <form class="d-inline-block" method="POST" action="{{ route('admin.posts.destroy', $post->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit" onclick="window.confirmDelete();" class="btn btn-danger" value="Delete">Delete</button> --}}
                                    <button type="submit"  class="btn btn-danger delete-post" value="Delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach   
                </tbody>
              </table>
        </div>
    </div>
    
@endsection