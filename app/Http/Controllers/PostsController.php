<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class PostsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with("user")->orderBy('created_at', 'DESC')->paginate(5);
        return view("posts.index", compact('posts'));
    }
    public function create()
    {
        return view("posts.create");
    }

    public function store()
    {
        $data = request()->validate([
            "caption" => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('upoads', 'public');
        // $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);
        // $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show($post)
    {

        $post = Post::findOrFail($post);
        return view(
            'posts.show',
            compact('post'),
        );
    }
}
