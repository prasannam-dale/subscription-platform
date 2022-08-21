<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_users()
    {
        User::factory()->create();
        $response = $this->getJson(route('user.index'));

        $response->assertStatus(200);

        $this->assertEquals(1, count($response->json()));
    }

    public function test_add_new_user()
    {
        $user = User::factory()->raw();

        $response = $this->postJson(route('user.store'), $user)
            ->assertCreated()
            ->json();

        $this->assertEquals($response['name'], $user['name']);
        $this->assertDatabaseHas('users', ['name' => $user['name']]);
    }
}
