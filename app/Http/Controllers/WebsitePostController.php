<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreWebsitePostRequest;
use App\Http\Requests\UpdateWebsitePostRequest;
use App\Models\User;
use App\Models\UserWebsite;
use App\Models\WebsitePost;
use App\Notifications\SendPostSubscribeEmail;
use Illuminate\Http\Response;

class WebsitePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = WebsitePost::all();
        return response()->json($posts, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWebsitePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebsitePostRequest $request)
    {
        $post = WebsitePost::create($request->validated());

        $users = UserWebsite::where('website_id', $request->website_id)->get();

        if (!empty($users)) {
            foreach ($users as $user) {
                $user->user->notify(new SendPostSubscribeEmail($post));
            }
        }

        return response()->json($post, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsitePost  $websitePost
     * @return \Illuminate\Http\Response
     */
    public function show(WebsitePost $websitePost)
    {
        return response()->json($websitePost, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsitePost  $websitePost
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsitePost $websitePost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebsitePostRequest  $request
     * @param  \App\Models\WebsitePost  $websitePost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWebsitePostRequest $request, WebsitePost $websitePost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsitePost  $websitePost
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsitePost $websitePost)
    {
        //
    }
}
