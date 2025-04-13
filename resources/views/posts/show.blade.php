@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex-wrap">
            <div class="col-8">
                <a href="/post/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100 h-60">
                </a>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="d-flex align-items-center pb-3">
                        <div class="pe-3">
                            <a href="/profile/{{ $post->user_id }}">
                                <img src="{{$post->user->profile->profileImage() }}" class="rounded-circle w-100"
                                    style="max-width: 50px">
                            </a>
                        </div>
                        <a href="/profile/{{ $post->user_id }}" class="text-decoration-none text-black">
                            <h3 class="font-weight-bold"><strong>{{ $post->user->username }}</strong></h3>
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="/profile/{{ $post->user_id }}" class="text-decoration-none text-black pe-3">
                            <p><strong>{{ $post->user->username }}</strong></p>
                        </a>
                        <p>{{ $post->caption }}</p>
                    </div>
                    @if ($post->isLikedBy(auth()->user()))
                        <form action="{{ route('likes.destroy', $post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("DELETE")
                            <button type="sumbit"><strong>Dislike</strong> </button>
                        </form>
                    @else
                        <form action="{{ route('likes.store', $post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <button type="sumbit"><strong>Like</strong></button>
                        </form>
                    @endif
                    <h5 class="pt-2 pb-2">{{ $post->likes()->count() }} Likes</h5>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form class="d-flex gap-4" action="{{ route('comments.store', $post->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="post_id" value="{{ $post->id }}"> --}}
                            <input name="body" class="form-control" placeholder="Add a comment..." required></input>
                            <button class="btn btn-primary m-2">Post</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="align-items-center">
                        <h2 class="pt-4 pb-2">Comments ({{ $post->comments->count() }})</h2>
                        @foreach($post->comments as $comment)
                            <div class="mt-2 d-flex align-items-center">
                                <a class="text-decoration-none text-black"
                                    href="/profile/{{ $comment->user_id }}"><strong>{{ $comment->user->username }}:</strong></a>
                                <div class="ps-2">{{ $comment->body }}</div>
                            </div>
                            <hr />
                        @endforeach
                        </h2>
                    </div>
                </div>
            </div>
        </div>
@endsection