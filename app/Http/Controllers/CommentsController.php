<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();

        foreach ($comments as $comment) {

            $user = User::findOrFail($comment->commenter_id)->first(); // Try this for other admins, see if it works.

            return view('admin.comments.index', compact('comments','user'));
        }

        return view('admin.comments.index', compact('comments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCommentRequest $request)
    {
        $user = Auth::user();
        $data = [
            'post_id' =>$request->post_id,
            'body' => $request->body,
            'commenter_id'=> $user->id,
        ];
        Comment::create($data);
//        $request->session()->flash('comment_message','Your comment has been sent and is waiting moderation');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::all();
        $post = Post::findOrFail($id);

        foreach ($comments as $comment) {

            $comments = $post->comments;

            $user = User::findOrFail($comment->commenter_id)->first(); // Try this for other admins, see if it works.
            return view('admin.comments.show', compact('comments','user'));
        }

        return view('admin.comments.show', compact('comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        Comment::findOrFail($id)->update($request->all());

        return redirect('/admin/comments');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Comment::findOrFail($id)->delete();

        return redirect()->back();

    }
}
