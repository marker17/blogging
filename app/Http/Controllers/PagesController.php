<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use Mail;

use App\Post;


class PagesController extends Controller
{
    

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

	public function postContact(Request $request){

		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message

			);

		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('brillomark@yahoo');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your email was sent');


		

		return redirect()->route('/');
	}




}
