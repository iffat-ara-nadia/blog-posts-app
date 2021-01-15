<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!!';
       //return view('pages.index', compact('title'));

       //If you want to pass multiple values as an array, you probably use this as well 
        return view('pages.index') ->with('title', $title); //this is better
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about') -> with('title', $title);
    }

    public function services(){
        //To pass multiple values as key-value pairs in an array
        $data = array( //I used {} instead of ()
            'title' => 'Services',
            'services' => ['Web Development', 'Programming', 'SEO']
        );
        return view('pages.services') ->with($data);
    }
};
