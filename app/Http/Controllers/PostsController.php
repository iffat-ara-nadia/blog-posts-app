<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;  //bring in the model
use DB;

class PostsController extends Controller
{    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {    
       //Brad's version
       $this->middleware('auth', ['except' => ['index', 'show']]);

       //Newer version from comment
       //$this->middleware('auth')->except(['index', 'show']);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //return $Post::where('title','Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::all(); //It will get all of our posts in an array
       
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999' //because, lot of apache server's default file upload size is 2 MB
                //So,if we don't set the file size, there's a good chance to upload a bigger image
            ]);
        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME); 
            // This is core php, no laravel

            //Get just ext
            //using Laravel here:
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //$ call the original filename with timestamp, makes the file name completely unique.
            //so that if someone uploads with same name,it's not gonna overriding anything like that.
            
            //Upload Image
            //create cover_images folder inside storage's public folder
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        //return 123;
        
        //Create Post
        $post = new Post; //we use 'App\Post' model
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; //this id will get the currently logged in user //we're not setting that to request,because it's not coming from the form, but we can use auth (as it's enable now)
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        //we don't have to update user, because it's never gonna change

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::find($id);
       return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post =  Post::find($id);
       //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

       return view('posts.edit')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>'required',
            'body' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);
        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        //We only want to delete it if it's not noimage.jpg. Because we
        //don't want the no-image to disappear, because we gonna need that,
        //incase someone upload a post without an image.
        if($post->cover_image != 'noinamge.jpg'){
            //Delete image 
            //Storage Object
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

       $post->delete();
       return redirect('/posts')->with('success', 'Post Deleted');
    }
}

//What functions we gonna need:
//index: listing of all the posts
//create: represents create form
//store: takes care of actually submitting it to the model to database.
//edit
//update
//destroy
//show: showing a single post
