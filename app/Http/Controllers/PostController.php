<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateArticleRequest;

use Purifier;

use App\Http\Requests;

use App\Post;

use Session;

use App\Category;

use App\Tag;


use Auth;

use Image;


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

        $posts = Post::latest('created_at')->paginate(10);


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


        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){

        // validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=> 'required|integer',
            'body'  => 'required'
        ));

        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(800, 400)->save($location);

          $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post was successfully save!');

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
    
    public function edit(CreateArticleRequest $request, $id){


 
        

        $post = Post::find($id);

        //if(Auth::user()->id == $post->user_id){ 

            $categories = Category::all();
            $cats=array();
            foreach($categories as $category){

                $cats[$category->id] = $category->name;
            }



            $tags =Tag::all();
            $tags2 = array();
            foreach($tags as $tag){

                $tags2[$tag->id] = $tag->name;
            }

            return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
        //}

        
        
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

        //$post->update(Purifier::clean($request->all()));
        

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->body);
        $post->save();


        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        
      
        Session::flash('success', 'This post was successfully edited.');

        return redirect()->route('posts.show', $post->id);
        

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreateArticleRequest $request, $id)
    {
        $post = Post::find($id);

        //if(Auth::user()->id == $post->user_id){ 
            //to safely delete tags, we make sure that posts dont link to non existent tags
            $post->tags()->detach();

            $post->delete();

            Session::flash('success', 'The post was successfully deleted.');


            return redirect()->route('posts.index');
        //}
        

    }
}
