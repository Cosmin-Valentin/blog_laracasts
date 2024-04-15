<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use App\Models\User;

class PostController extends Controller
{
    public function index() {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author']))
            ->where('status', 'published')->paginate(9)->withQueryString()
        ]);
    }

    public function show(Post $post) {
        $post->increment('views_count');
        
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function follow() {
        $attributes = request()->validate([
            'author_id' => 'required'
        ]);
        $author = User::where('id', $attributes['author_id'])->first();
        $email = auth()->user()->email;

        $followerEmail = collect(explode(',', $author->followers))
            ->map(fn($string) => trim($string))
            ->filter()
            ->all();

        if(!in_array($email, $followerEmail)) {
            $author->followers = $email . ',' . $author->followers;
            $author->save();
        }

        return back()->with('success', 'You are now following '.ucfirst($author->name));
    }

    public function bookmark() {
        $attributes = request()->validate([
            'post_id' => 'required'
        ]);
        $user = auth()->user();
        
        $bookmarks = collect(explode(',', $user->bookmarks))
            ->map(fn($string) => trim($string))
            ->filter()
            ->all();
        if(!in_array($attributes['post_id'], $bookmarks)) {
            $user->bookmarks = $attributes['post_id'] . ',' . $user->bookmarks;
            $user->save();
        }

        return back()->with('success', 'Post has been bookmarked');
    }
}
