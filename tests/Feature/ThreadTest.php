<?php

namespace Tests\Feature;

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
        $this->seed(\ThreadsTableSeeder::class);
        $response = $this->get('/threads/1');
        $response->assertStatus(200);

        $response = $this->get('/threads/2');
        $response->assertStatus(200);

        $response = $this->get('/threads/a');
        $response->assertStatus(404);
    }

    public function testThreadView()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    public function testActionIndexOnController()
    {
        $user = factory(User::class)->create();
        $this->seed(\ThreadsTableSeeder::class);
        $threads = Thread::orderBy('updated_at', 'desc')->paginate();
        $response = $this
            ->actingAs($user)
            ->json('GET', '/threads');
        $response->assertStatus(200)
            ->assertJsonFragment([$threads->toArray()['data']]);
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
        $thread = Thread::find(1);
        $response->assertStatus(201)
            ->assertJson(['created' => 'success', 'data' => $thread->toArray()]);
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
