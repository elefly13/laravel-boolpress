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
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$category['id']}}</th>
                            <td>{{$category['name']}}</td>
                            <td>{{$category['slug']}}</td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category->id)}}"
                                    class="btn btn-info">
                                    Details
                                </a>
                                <a href=""
                                    class="btn btn-light">
                                    Modify
                                </a>
                                <form class="d-inline-block" method="POST" action="">
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