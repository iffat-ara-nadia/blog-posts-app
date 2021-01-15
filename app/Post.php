<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    //Creating a relationship with user 
    //Means single Post has a relationship with user and belongs to an user
    public function user(){
         return $this->belongsTo('App\User'); // this post 
    }
}

//to get all posts
//Post::all();