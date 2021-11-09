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
                    <th scope="col">slug</th>
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
                                    <button type="submit" class="btn btn-danger" value="Delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach   
                </tbody>
              </table>
        </div>
    </div>
    
@endsection