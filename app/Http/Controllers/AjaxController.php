<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getPostContent($post_id)
    {
         $comments = Comment::where('post_id',$post_id)->select('body','users.name')
            ->join('users', 'users.id' ,'=','comments.commenter_id')->get();

        return \response()->json(['status'=>'ok','comments'=>$comments]);

    }
}
