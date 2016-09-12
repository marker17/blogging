<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{

	
    protected $fillable = [
        'user_id','title', 'body', 'slug', 'category_id',
    ];

    /*
    protected $casts = [
        'tags' => 'array',
    ];
    */

	public function category(){

	 //a post belongs to a category

		return $this->belongsTo('App\Category');

	}

	public function tags(){

		return $this->belongsToMany('App\Tag');
	}

	public function comments(){

		return $this->hasMany('App\Comment');
	}

	public function user(){
        return $this->belongsTo('App\User');

    }


}


