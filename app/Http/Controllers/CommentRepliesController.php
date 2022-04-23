<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies = CommentReply::all();

            $comment_id =  $replies[0]->comment_id;
            $comment =  Comment::whereId($comment_id)->first();
            return view('admin.comments.replies.index',compact('replies','comment','comment_id'));

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
    public function store(Request $request)
    {
        //
    }


    public function createReply(Request $request){

        $user = Auth::user();

        $data = [
            'replier_id' => $user->id,
            'comment_id' => $request->comment_id,
            'body'=>$request->body
        ];

        CommentReply::create($data);

        $request->session()->flash('reply_message','Your reply has been sent and is waiting moderation');

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

        $comment = Comment::whereId($id)->first();

        $replies = $comment->replies;

        return view(' admin.comments.replies.show', compact('replies','comment'));

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
        //

        CommentReply::findOrFail($id)->update($request->all());


        return redirect()->back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        CommentReply::findOrFail($id)->delete();

        return redirect()->back();

    }





}
