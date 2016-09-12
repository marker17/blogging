<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

use App\Post;

use App\User;

class CreateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        $user    = app( 'auth' )->user();
        $post = Post::findOrFail( $this->posts );  // "posts" is a route parameter
        return $post->user_id === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
