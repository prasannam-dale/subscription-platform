<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserWebsiteRequest;
use App\Http\Requests\UpdateUserWebsiteRequest;
use App\Models\UserWebsite;
use Illuminate\Http\Response;

class UserWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userWebsites = UserWebsite::all();
        return response()->json($userWebsites, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserWebsiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserWebsiteRequest $request)
    {
        $userWebsite = UserWebsite::create($request->validated());
        return response()->json($userWebsite, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserWebsite  $userWebsite
     * @return \Illuminate\Http\Response
     */
    public function show(UserWebsite $userWebsite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserWebsite  $userWebsite
     * @return \Illuminate\Http\Response
     */
    public function edit(UserWebsite $userWebsite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserWebsiteRequest  $request
     * @param  \App\Models\UserWebsite  $userWebsite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserWebsiteRequest $request, UserWebsite $userWebsite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserWebsite  $userWebsite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWebsite $userWebsite)
    {
        //
    }
}
