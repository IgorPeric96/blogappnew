<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Mail\CreatePostMail;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        // dd($request->all());
        $comment = Comment::create([
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
            'content' => $request->input('content'),
        ]);

        $postCommentsGroupedByUser = $comment->post->comments->groupBy('user_id');
        
        foreach($postCommentsGroupedByUser as $postComments) {
            $user = $postComments->first()->user;
            $email = $user->email;
            $userId = $user->id;
            Mail::to($email)->send(new CreatePostMail($userId));
        }
        
        return redirect()->back()->with('status', 'Comment added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        Comment::findOrFail('$id')->update(['content' => $request->input('content')]);
        return redirect()->back()->with('status', 'Comment Succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('status', 'Comment deleted succesfully.');
    }
}