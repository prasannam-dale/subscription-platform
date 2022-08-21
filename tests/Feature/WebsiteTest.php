<?php

namespace Tests\Feature;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_website()
    {
        Website::factory()->create();
        $response = $this->getJson(route('website.index'));

        $response->assertStatus(200);

        $this->assertEquals(1, count($response->json()));
    }

    public function test_add_new_website()
    {
        $website = Website::factory()->raw();

        $response = $this->postJson(route('website.store'), $website)
            ->assertCreated()
            ->json();

        $this->assertEquals($response['name'], $website['name']);
        $this->assertDatabaseHas('websites', ['name' => $website['name']]);
    }

    public function test_when_storing_a_new_website_name_field_is_required()
    {
        $this->withExceptionHandling();
        $response = $this->postJson(route('website.store'));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
}
