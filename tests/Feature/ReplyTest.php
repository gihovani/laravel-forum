<?php

namespace Tests\Feature;

use App\Http\Resources\ReplyResource;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function testRepliesListByThread()
    {
        $user = factory(User::class)->create();
        $this->seed(\RepliesTableSeeder::class);
        $replies = Reply::where('thread_id', 2)->get();
        $replies = ReplyResource::collection($replies);

        $this->actingAs($user)
            ->json('GET', '/replies/2')
            ->assertStatus(200)
            ->assertJsonFragment($replies->resolve()[0]);
    }

    public function testActionStoreOnController()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', '/replies/' . $thread->id, [
                'body' => 'resposta no forum',
                'thread_id' => $thread->id
            ])->assertStatus(201);
        $response
            ->assertJsonFragment(['created' => 'success']);
    }
}
