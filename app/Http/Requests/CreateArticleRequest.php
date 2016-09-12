<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

use App\Post;

class CreateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
        $post = Post::find($id);
        if(Auth::id() == $post->user_id){ 

            return true;
        }
        */
        $user = app( 'auth' )->user();
        $post = Post::findOrFail( $this->get( 'id' ) );

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
