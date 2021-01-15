@extends('layouts.app')

@section('content')
    <h1>Create Post</h1> 
    {!! Form::open(['action' => 'PostsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
       <div class="form-group">
           {{form::label('title','Title')}}
           {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
       </div>
       <div class="form-group">
        {{form::label('body','Body')}}
        {{-- I wrote 'Body' instead of 'body' in textarea --}}
        {{Form::textarea('body','',['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>

    {{Form::submit('Submit',['class' => 'btn btn-secondary'])}}
   {!! Form::close() !!} 
@endsection