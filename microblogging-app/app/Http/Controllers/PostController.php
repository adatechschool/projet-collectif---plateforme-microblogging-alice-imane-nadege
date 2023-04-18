<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display all posts on dashboard page.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }
    /**
     * Display biography.
    */
    public function retrieveBio($id)
    {
        $user = User::find($id);
        $biography = $user->biography;
        return $biography;
    }
    /**
     * Display posts from the loggued user.
     */
    public function showpostUser()
    {
        $user_Id = Auth::user()->id;
        $posts = Post::where('user_id', $user_Id)
            ->orderBy('created_at','desc')
            ->get();
        $biography = $this->retrieveBio($user_Id);
        return view('mypage', compact('posts','biography'));
    }
    /**
     * Display posts from the visited user profile.
     */
    public function showAnotherPage(Request $request, $id)
    {
        $posts = Post::where('user_id', $id)
        ->orderBy('created_at','desc')
        ->get();
        $biography = $this->retrieveBio($id);
        return view('mypage', compact('posts','biography'));
    }
    /**
     * Store a newly created post in storage.
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
    public function destroy(Post $post)
    {
        //
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

        return redirect()->back()->with('message','Post Like do successfully!');
    }

    public function unlikePost($id)
    {
        $post = Post::find($id);
        $post->unlike();
        $post->save();
        
        return redirect()->back()->with('message','Post Like undo successfully!');
    }
}
