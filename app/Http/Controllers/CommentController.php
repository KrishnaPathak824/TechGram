<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    use HasFactory;
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function store(Post $post)
    {

        $data = request()->validate([
            "body" => ["required", "string", "max:255"]
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            "body" => $data['body'],
        ]);

        return redirect("/post/" . $post->id)->with("success", "");
    }
}

