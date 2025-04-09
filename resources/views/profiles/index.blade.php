@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5 ">
                <img src="{{ $user->profile->profileImage() }}"
                    class="w-100 rounded-circle">
            </div>
            <div class="col-8 p-5">

                {{-- <div class="d-flex gap-50"> --}}
                    
                        <h1>{{ $user->username }}</h1>
                        
                    
                    <div class="d-flex gap-3">
                    @can('update',$user->profile)
                    <button class="btn btn-primary"><a href="/profile/{{ $user->id }}/edit" class="text-decoration-none pt-2  text-white" >Edit Profile</a></button>
                    @endcan
                    @can('update',$user->profile)
                        <button class="btn btn-primary"><a href="/post/create" class="text-decoration-none pt-2 text-white">Add new Post</a></button>
                        @endcan
                </div>
                    {{--
                </div> --}}
                <div class="d-flex gap-5 pt-2">
                    <div class=""><strong>{{$user->posts->count();}} posts</strong></div>
                    <div class=""><strong>23k followers</strong></div>
                    <div class=""><strong>212 following</strong></div>
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
            @if ($user->posts && $user->posts->count()>0) 
            @foreach ($user->posts as $post)
                <div class="col-4 pt-4">
                    <a href="/post/{{ $post->id }}">
                    <img class="w-100 h-100 border border-black" src="/storage/{{ $post->image }}">
                    </a>
                </div>
            @endforeach
            @else
            <div class="p-10">
                <h2 >No Posts Available</h2>
            </div>
            @endif
        </div>
    </div>
@endsection