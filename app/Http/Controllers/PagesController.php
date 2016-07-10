<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class PagesController extends Controller{
	
	public function getIndex(){
		$posts=Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);




	}
	public function getAbout(){

		$first = 'Mark';
		$last = 'Brillo';
		$fullname = $first . "". $last;
		$email='brillomark@yahoo.com';
		return view('pages.about')->withFullname($fullname)->withEmail($email);

	}
	public function getContact(){
		return view('pages.contact');
	}
}



