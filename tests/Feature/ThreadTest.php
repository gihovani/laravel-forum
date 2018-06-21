<?php

namespace Tests\Feature;

use App\Thread;
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
        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }
}
