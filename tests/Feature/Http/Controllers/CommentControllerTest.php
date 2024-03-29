<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewComment;
use App\Jobs\SyncMedia;
use App\Mail\ReviewComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommentController
 */
final class CommentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $comments = Comment::factory()->count(3)->create();

        $response = $this->get(route('comments.index'));

        $response->assertOk();
        $response->assertViewIs('comment.index');
        $response->assertViewHas('comments');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommentController::class,
            'store',
            \App\Http\Requests\CommentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $post = Post::factory()->create();

        Mail::fake();
        Queue::fake();
        Event::fake();

        $response = $this->post(route('comments.store'), [
            'name' => $name,
            'post_id' => $post->id,
        ]);

        $comments = Comment::query()
            ->where('name', $name)
            ->where('post_id', $post->id)
            ->get();
        $this->assertCount(1, $comments);
        $comment = $comments->first();

        $response->assertRedirect(route('comment.index'));
        $response->assertSessionHas('comment.name', $comment->name);

        Mail::assertSent(ReviewComment::class, function ($mail) use ($comment) {
            return $mail->hasTo($post->author->notification) && $mail->comment->is($comment);
        });
        Queue::assertPushed(SyncMedia::class, function ($job) use ($Comment) {
            return $job->Comment->is($Comment);
        });
        Event::assertDispatched(NewComment::class, function ($event) use ($comment) {
            return $event->comment->is($comment);
        });
    }
}
