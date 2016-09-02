<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //tell laravel to use the categories model
    protected $table = 'categories';

    protected $fillable = [
       
    	'name',

    ];


    public function posts(){

    	return $this->hasMany('App\Post');
    }
}


