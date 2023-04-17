<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('dashboard', ['posts' => $posts]);
    }

    public function showpostUser()
    {
        $email = Auth::user()->email;
        $user_Id = User::where('email',$email)->pluck('id')->first();
        $posts = Post::where('user_id', $user_Id)->get();
        return view('mypage', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('mypage');
    // }

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
    public function destroy(Post $post)
    {
        //
    }
}
