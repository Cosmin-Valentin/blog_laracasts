<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function bookmarks() {
        $bookmarks = auth()->user()->bookmarks;
        if(!empty($bookmarks)) {
            $bookmarks = explode(',', $bookmarks);
            $posts = Post::whereIn('id', $bookmarks)->get();
        } else {
            $posts = collect();
        }
        return view('posts.bookmarks', [
            'posts' => $posts
        ]);
    }

    public function edit() {
        return view('account.edit');
    }

    public function update() {
        $attributes = request()->validate([
            'username' => 'required|min:3|max:255',
            'avatar' => 'image'
        ]);
        if(isset($attributes['avatar'])) {
            $attributes['avatar'] = request()->file('avatar')->store('avatars');
        }
        auth()->user()->update($attributes);

        return back()->with('success', 'Profile Updated!');
    }
}
