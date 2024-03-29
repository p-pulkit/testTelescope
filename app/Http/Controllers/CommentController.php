<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Http\Requests\CommentStoreRequest;
use App\Jobs\SyncMedia;
use App\Mail\ReviewComment;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(Request $request): View
    {
        $comments = Comment::all();

        return view('comment.index', compact('comments'));
    }

    public function store(CommentStoreRequest $request): RedirectResponse
    {
        $comment = Comment::create($request->validated());

        Mail::to($post->author->notification)->send(new ReviewComment($comment));

        SyncMedia::dispatch($Comment);

        NewComment::dispatch($comment);

        $request->session()->flash('comment.name', $comment->name);

        return redirect()->route('comment.index');
    }
}
