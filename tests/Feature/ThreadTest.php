<?php

namespace Tests\Feature;

use App\Http\Resources\ThreadResource;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testThreads()
    {
        $user = factory(User::class)->create();
        $this->seed(\ThreadsTableSeeder::class);
        $response = $this
            ->actingAs($user)
            ->get('/threads/1');
        $response->assertStatus(200);

        $response = $this
            ->actingAs($user)
            ->get('/threads/2');
        $response->assertStatus(200);

        $response = $this
            ->actingAs($user)
            ->get('/threads/a');
        $response->assertStatus(404);
    }

    public function testThreadView()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        $response = $this
            ->actingAs($user)
            ->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    public function testActionIndexOnController()
    {
        $user = factory(User::class)->create();
        factory(Thread::class, 2)->create();
        $threads = Thread::orderBy('fixed', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        $threads = ThreadResource::collection($threads);

        $response = $this
            ->actingAs($user)
            ->json('GET', '/threads');
        $response->assertStatus(200)
            ->assertJsonFragment($threads->resolve()[0]);
    }

    public function testActionStoreOnController()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->actingAs($user)
            ->json('POST', '/threads', [
                'title' => 'meu primeiro tópico',
                'body' => 'Este é um exemplo de tópico!'
            ]);
        $response->assertStatus(201)
            ->assertJsonFragment(['created' => 'success']);
    }

    public function testActionUpdateOnController()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create(['user_id' => $user->id]);
        $thread->title = 'meu primeiro tópico atualizado';
        $thread->body = 'Este é um exemplo de tópico atualizado!';
        $response = $this
            ->actingAs($user)
            ->json('PUT', '/threads/' . $thread->id, $thread->toArray());
        $response->assertStatus(302);
        $this->assertEquals(Thread::find($thread->id)->toArray(), $thread->toArray());
    }
}
