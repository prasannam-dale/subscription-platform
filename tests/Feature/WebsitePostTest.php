<?php

namespace Tests\Feature;

use App\Models\WebsitePost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebsitePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_posts()
    {
        WebsitePost::factory()->create();
        $response = $this->getJson(route('post.index'));

        $response->assertStatus(200);

        $this->assertEquals(1, count($response->json()));
    }

    public function test_fetch_a_post()
    {
        $post = WebsitePost::factory()->create();
        $response = $this->getJson(route('post.show', $post->id));

        $response->assertStatus(200);

        $this->assertEquals($post->id, $response->json()['id']);
    }

    public function test_store_a_new_post()
    {
        $post = WebsitePost::factory()->raw();

        $response = $this->postJson(route('post.store'), $post)
            ->assertCreated()
            ->json();

        $this->assertEquals($response['title'], $post['title']);
        $this->assertDatabaseHas('website_posts', ['title' => $post['title']]);
    }
}
