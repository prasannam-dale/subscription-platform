<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserWebsite;
use App\Models\Website;
use App\Models\WebsitePost;
use App\Notifications\SendPostSubscribeEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    // use RefreshDatabase;

    public function test_when_a_post_created_on_a_particular_website_all_subscribe_users_should_get_a_email_notification()
    {
        Notification::fake();

        $website = Website::factory()->create();
        $subscriber1 = UserWebsite::factory()->create(['website_id' => $website->id]);
        $subscriber2 = UserWebsite::factory()->create(['website_id' => $website->id]);
        $subscriber3 = UserWebsite::factory()->create();

        $post = WebsitePost::factory()->raw(['website_id' => $website->id]);

        $response = $this->postJson(route('post.store'), $post)
            ->assertCreated()
            ->json();

        Notification::assertSentTo($subscriber1->user, SendPostSubscribeEmail::class);
        Notification::assertSentTo($subscriber2->user, SendPostSubscribeEmail::class);
        Notification::assertNotSentTo($subscriber3->user, SendPostSubscribeEmail::class);
    }
}
