<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Events\NewPost;
use App\Http\Requests\PostStoreRequest;
use App\Jobs\SyncMedia;
use App\Mail\ReviewPost;
use App\Models\Post;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create(Request $request): View
    {
        $user = User::find($id);

        return view('post.create', compact('user'));
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated());

        Mail::to($post->author->email)->send(new ReviewPost($post));

        SyncMedia::dispatch($post);

        NewPost::dispatch($post);

        $request->session()->flash('post.title', $post->title);

        return redirect()->route('posts.index');
    }

    public function show(Request $request, Post $post): View
    {
        $comments = Comments::find($post_id);

        return view('post.show', compact('post', 'comments'));
    }
}
