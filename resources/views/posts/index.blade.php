@extends('layouts.app')

@section('content')
    <h1 class="py-4">Posts</h1> 
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <div class="d-block p-2 bg-dark text-white">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/posts/ {{$post->id}}">{{$post->title}}</a></h3>
                    <h6>Written on {{$post->created_at}} by {{$post->user->name}} </h6>
                </div>
            </div> 
        </div>    
        @endforeach
        <hr>
        {{$posts->links()}}
    @else
    <p>No posts found</p>
    @endif
@endsection