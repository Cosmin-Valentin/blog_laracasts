<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class RSSController extends Controller
{
    public function index() {
        $posts = Post::latest()->get();

        return view('feed.rss-feed', [
            'posts' => $posts
        ]);
    }
}