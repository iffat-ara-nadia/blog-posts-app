@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{ $title }} </h1>
        <p>This is the laravel application from 'Laravel From Scratch' youtube series</p>
        <p>
            <a href="/login" class="btn btn-secondary btn-lg" role = "button">Login</a>
            <a href="/register" class="btn btn-danger btn-lg" role = "button">Register</a>
        </p> 
    </div>
   
@endsection

