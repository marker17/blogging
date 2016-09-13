<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Category;

use App\Comment;








class BlogController extends Controller
{

	public function getIndex(){

		$categories =Category::all();

		$posts = Post::latest('created_at')->paginate(10);

		return view('blog.index')->withPosts($posts)->withCategories($categories);

	}





    public function getSingle($slug){

    	


    	$post = Post::where('slug', '=', $slug)->first();

    	return view('blog.single')->withPost($post);
    }
}
