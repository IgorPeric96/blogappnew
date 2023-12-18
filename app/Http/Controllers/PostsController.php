<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Mail\CreatePostMail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view('pages.posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {


        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id
        ]);

        $post->tags()->attach($request->tags);

        $userEmail = Auth::user()->email;
        $mailData = $post->only('title', 'body'); // ovu prosljedjujemo dole ispod u new
        Mail::to($userEmail)->send(new CreatePostMail($mailData));

        return redirect('createpost')->with('status', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->get();
        return view('pages.post', compact('post', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        Post::findOrFail($id)->update(['title' => $request->input('title'), 'body' => $request->input('body')]);
        return redirect()->back()->with('status', 'Post updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id)->delete();
        return redirect('/posts')->with('status', 'Post deleted succesfully!');
    }

    public function createPost()
    {
        $tags = Tag::all();

        return view('pages.createpost', compact('tags'));
    }
}
