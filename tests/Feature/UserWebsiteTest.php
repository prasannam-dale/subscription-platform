<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserWebsite;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_user_websites()
    {
        UserWebsite::factory()->create();
        $response = $this->getJson(route('user-website.index'));

        $response->assertStatus(200);

        $this->assertEquals(1, count($response->json()));
    }

    public function test_store_new_user_website()
    {
        $userWebsite = UserWebsite::factory()->raw();

        $response = $this->postJson(route('user-website.store'), $userWebsite)
            ->assertCreated()
            ->json();

        $this->assertEquals($response['user_id'], $userWebsite['user_id']);
        $this->assertDatabaseHas('user_websites', ['user_id' => $userWebsite['user_id'], 'website_id' => $userWebsite['website_id']]);
    }

    public function test_when_storing_a_new_user_to_a_website_user_and_website_fields_are_required()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('user-website.store'));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['user_id', 'website_id']);
    }

    public function test_when_storing_a_new_user_to_a_website_user_id_should_be_valid()
    {
        $this->withExceptionHandling();
        $website = Website::factory()->create();
        $user = User::factory()->make();
        $response = $this->postJson(route('user-website.store'), ['user_id' => $user->id, 'website_id' => $website->id]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['user_id']);
    }

    public function test_when_storing_a_new_user_to_a_website_website_id_should_be_valid()
    {
        $this->withExceptionHandling();
        $website = Website::factory()->make();
        $user = User::factory()->create();
        $response = $this->postJson(route('user-website.store'), ['user_id' => $user->id, 'website_id' => $website->id]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['website_id']);
    }
}
