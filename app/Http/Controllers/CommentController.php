<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
     public function save(Request $request, Post $post)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'body' => 'required|string',
        ]);

        
        $post->comments()->create($validated);

        
        return redirect()->route('post', $post)->with('success', 'You Just Made a Comment');
    }

   
}
