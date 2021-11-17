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

                <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
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
{{-- inserimento immagine cover --}}
                    <div class="form-group">
                        <label for="image" >Immagine di copertina</label><br>
                        <input type="file" id="image" name="image" @error('image') is-invalid @enderror>
                        @error('image')
                            <div class="alert alert-danger">{{ $message}}</div> 
                        @enderror
                    </div>
{{-- fine inserimento immagine cover  --}}

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">--Seleziona la categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : null }}
                                    >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Seleziona i tag</p>
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input value="{{ $tag->id }}" id="{{ 'tag' . $tag->id }}" type="checkbox" name="tags[]" class="form-check-input"
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : null }} >
                                <label for="{{ 'tag' . $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                        
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Post</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    
@endsection