@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex-wrap">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100 h-60">
            </div>
            <div class="col-4">
                <div class="d-flex align-items-center pb-3">
                    <div class="pe-3">
                        <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100"
                            style="max-width: 50px">
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
            </div>
        </div>
    </div>
@endsection