@extends('layouts.app')

@section('content')
    <h1 class="py-4">{{$post->title}}</h1> 
    <img style="width:400px" src="/storage/cover_images/{{$post->cover_image}}" alt="">
    <br><br>
    <div>
        {{-- {{}} braces don't parse the html body. !! does --}}
        {!!$post->body!!} 
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}} </small>
    <hr>
    @if(!Auth::guest())
     @if(Auth::user()->id == $post->user_id)
    {{-- I did {post->id} instead of {{}} --}}
    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
     {{-- not {{!!Form!!}}, {!!Form!!} --}}
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
     @endif
    @endif
    <hr>
    <div>
        <a href="/posts" class="btn btn-secondary">Go Back</a>
    </div>  

@endsection