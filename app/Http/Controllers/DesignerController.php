<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignerController extends Controller
{
    public function likeThePost(Request $request)
    {
        $request->validate(['post_id' => 'required|numeric']);
        $user_id = auth()->id();
        $post_id = $request->post_id;

        $like_of_post = Like::withTrashed()->whereUser_id($user_id)->whereModel_type('App\Models\Post')
            ->whereModel_id($post_id)->first();

        if (isset($like_of_post)) {
            if ($like_of_post->deleted_at == null)
                //unlike
                $like_of_post->delete();
            else {
                //like the post again
                $like_of_post->deleted_at = null;
                $like_of_post->update();
            }
        }else {
            //like the post for the first time
            $like_of_post = new Like;
            $like_of_post->user_id = $user_id;
            $like_of_post->model_type = 'App\Models\Post';
            $like_of_post->model_id = $post_id;
            $like_of_post->save();
        }

        return back();
    }
}
