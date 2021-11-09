@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Creazione nuovo post</h1>

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <form action="{{ route('admin.posts.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message}}</div> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Contenuto</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content')}}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message}}</div> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Post</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
@endsection