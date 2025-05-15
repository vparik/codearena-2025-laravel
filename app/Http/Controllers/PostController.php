<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::when($user, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })
        
        ->whereNotNull('image')
        ->whereNotNull('published_at')
        ->orderBy('promoted', 'desc')
        ->orderBy('published_at','desc')    
        ->paginate(9);


        $authors = User::whereHas('posts', function ($query) {
            $query->whereNotNull('published_at');
        })->get();

        $message = $posts->isEmpty() ? 'No posts found.' : null;



        return view('posts.index', compact('posts','message','authors'));

    }

    public function show(Post $post)
    {
        if (is_null($post->published_at)) {
        abort(404);
        }

        return view('posts.show', compact('post'));
    }

   public function promoted()
    {
        $posts = Post::where('promoted', true)
            ->paginate(9);

        $message = $posts->isEmpty() ? 'No posts found.' : null;

        $authors = User::whereHas('posts', function ($query) {
            $query->where('promoted', true);
        })->get();

        return view('posts.index', compact('posts', 'message', 'authors'));
    }


}
