<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function showpostUser()
    {
        $user_Id = Auth::user()->id;
        $posts = Post::where('user_id', $user_Id)
            ->orderBy('created_at','desc')
            ->get();
        return view('mypage', ['posts' => $posts]);
    }

    public function showAnotherPage(Request $request, $id)
    {
        $posts = Post::where('user_id', $id)
        ->orderBy('created_at','desc')
        ->get();
        return view('mypage', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_Id = Auth::id();

        $validatedData = $request->validate([
            'description' => 'required|string',
            'img_url' => 'required|string',
        ]);

        $post = new Post([
            'description' => $validatedData['description'],
            'img_url' => $validatedData['img_url'],
            'user_id' => $user_Id,
        ]);
        $post->save();
        
        return redirect()->route('mypage')->with('success', 'Post successfully saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, $id)
    {
        $posts = Post::orderBy('created_at','desc')->get();
        $post = Post::find($id);
       
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
    
        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $post->destroy();
    
        return redirect()->view('mypage', ['posts' => $posts]);
    }

    /*Like gestion*/
    /*
    with this tuto https://larainfo.com/blogs/how-to-create-post-like-and-unlike-button-in-laravel
    composer require rtconner/laravel-likeable
    */
    public function likePost($id)
    {
        $post = Post::find($id);
        $post->like();
        $post->save();

        return redirect()->back()->with('message','Post Like undo successfully!');
    }

    public function unlikePost($id)
    {
        $post = Post::find($id);
        $post->unlike();
        $post->save();
        
        return redirect()->back()->with('message','Post Like undo successfully!');
    }
}