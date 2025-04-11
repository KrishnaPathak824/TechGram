@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5 ">
                <img src="{{ $user->profile->profileImage() }}" class="w-100 rounded-circle">
            </div>
            <div class="col-8 p-5">

                {{-- <div class="d-flex gap-50"> --}}
                    <div class="d-flex gap-3">
                        <h1>{{ $user->username }}</h1>
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    </div>
                    <div class="d-flex gap-3">
                        @can('update', $user->profile)
                            <a href="/profile/{{ $user->id }}/edit" class="text-decoration-none pt-2  text-white"><button
                                    class="btn btn-primary">Edit Profile</button></a>
                        @endcan
                        @can('update', $user->profile)
                            <a href="/post/create" class="text-decoration-none pt-2 text-white"><button
                                    class="btn btn-primary">Add new Post</button></a>
                        @endcan
                    </div>
                    {{--
                </div> --}}
                <div class="d-flex gap-5 pt-2">
                    <div class=""><strong>{{$postCount}} posts</strong></div>
                    <div class=""><strong>{{$followerCount}} followers</strong></div>
                    <div class=""><strong>{{ $followingCount }} following</strong></div>
                </div>
                <div class="pt-2"><strong>{{ $user->profile->title }}</strong></div>
                <div>{{ $user->profile->description }}
                </div>
                <div class="">
                    <a href="#">{{   $user->profile->url }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($user->posts && $user->posts->count() > 0)
                @foreach ($user->posts as $post)
                    <div class="col-4 pt-4">
                        <a href="/post/{{ $post->id }}">
                            <img class="w-100 h-100 border border-black" src="/storage/{{ $post->image }}">
                        </a>
                    </div>
                @endforeach
            @else
                <div>
                    <h2>No Posts Available</h2>
                </div>
            @endif

        </div>
    </div>
@endsection