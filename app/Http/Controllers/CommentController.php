<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post) {
        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' =>request()->user()->id,
            'body' => request('body')
        ]);

        return back();
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return back()->with('success', 'Comment removed!');
    }
}
