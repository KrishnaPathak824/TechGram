<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function store(Post $post)
    {

        $post->likes()->firstOrCreate([
            "user_id" => auth()->id(),
        ]);

        return back()->with("success", "");
    }

    public function destroy(Post $post)
    {
        $post->likes()->where("user_id", auth()->id())->delete();
        return back()->with("success", "");
    }
}
