@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($posts && $posts->count() > 0)
            @foreach ($posts as $post)
                <div class="row">
                    <div class="col-6 offset-3">
                        <a href="/post/{{ $post->id }}">
                            <img src="/storage/{{ $post->image }}" class="w-100 h-60">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3 pt-3 pb-5">
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
                            <p class="pt-2 ps-4">{{ $post->caption }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            <div>
                <h2>No Posts Available</h2>
            </div>
        @endif
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection