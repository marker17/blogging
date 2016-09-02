<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use Session;

use App\Category;



class PostController extends Controller
{   


    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $posts = Post::orderBy('id', 'desc')->paginate(10);


        return view('posts.index')->withPosts($posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //neeed to grab all the categories and pass to a variable
        $categories=Category::all();

        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'=>'required'
        ));
    
        
        $post=Post::create($request->all());  
        
    
        
        Session::flash('success', 'The blog post was successfully saved!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $post = Post::find($id);

        $categories = Category::all();
        $cats=array();
        foreach($categories as $category){

            $cats[$category->id] = $category->name;
        }

        return view('posts.edit')->withPost($post)->withCategories($categories);
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

        $post = Post::find($id);


        if($request->input('slug') == $post->slug){
            $this->validate($request, array(
                'title' => 'required|max:255',
                'category_id'=> 'required|integer',
                'body' => 'required'
            ));
        } 
        else{



            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'=> 'required|integer',
                'body'=>'required'
            ));

        }   

        $post = Post::find($id);
        
        $post->update($request->all());
        
      
        Session::flash('success', 'This post was successfully edited.');

        return redirect()->route('posts.show', $post->id);
        
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

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');


        return redirect()->route('posts.index');
    }
}
