<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\MailchimpNewsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() {
        return view('admin.create');
    }

    public function store() {
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')
            ],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ]
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post) {
        return view('admin.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post) {
        $attributes = request()->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')
            ],
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => 'required',
            'status' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ]
        ]);

        if(isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        if($attributes['status'] === 'published' && $post->status !== 'published') {
            $author = User::where('id', $attributes['user_id'])->first();
            if(!empty($author->followers)) {
                $this->sendNewPostEmail($author);
            }
        }
        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post) {
        $post->delete();

        return back()->with('Success', 'Post Deleted!');
    }

    protected function sendNewPostEmail($author) {
        $followerEmail = collect(explode(',', $author->followers))
                ->map(fn($string) => trim($string))
                ->filter()
                ->all();
        try {
            $mailChimp = app(MailchimpNewsletter::class);
            $mailChimp->newPost($followerEmail);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }
    }
}
