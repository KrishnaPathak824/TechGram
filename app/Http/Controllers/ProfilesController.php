<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    //
    public function index($user)
    {
        $user = User::findOrFail($user);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember('counts.post' . $user->id, now()->addSecond(30), function () use ($user) {
            return $user->posts->count();
        });

        $followerCount = Cache::remember('counts.follower' . $user->id, now()->addSecond(30), function () use ($user) {
            return $user->profile->followers()->count();
        });

        $followingCount = Cache::remember('counts.followings' . $user->id, now()->addSecond(30), function () use ($user) {
            return $user->following()->count();
        });

        return view("profiles.index", [
            'user' => $user,
            'follows' => $follows,
            "postCount" => $postCount,
            'followerCount' => $followerCount,
            'followingCount' => $followingCount
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view("profiles.edit", compact("user"));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            "title" => "required",
            "description" => "required",
            "url" => "url",
            "image" => "image"
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $image ?? [],
        ));

        return redirect('/profile/' . $user->id);
    }
}
