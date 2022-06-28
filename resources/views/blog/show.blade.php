@extends('layouts.app')
@section('header')

        <div class="bg-dark text-light w-100 h-100 d-flex align-items-center justify-content-center" >

            <div class="text-center my-5 py-5 box">
                <h1 class="text-light fw-bold mb-3">Blog posts</h1>
                <h4 class="text-light p-0 text-center ">
                    Place to find like-minded friends.
                </h4>

                <h4 class="text-light fw-bold mb-3 "> A CAR MOVES YOU. A BMW TOUCHES YOU.</h4>
                <div class="d-flex justify-content-center">
                <a href="/post/create" class="btn btn-outline-light btn-lg m-2"> Create a post </a>
                @if (isset(Auth::user()->id)&& Auth::user()->id == $post->user_id)
                    <a href="/post/{{$post->id}}/edit" class="btn btn-outline-success btn-lg m-2 ml-4"> Edit Post</a>
                    <form action="/post/{{$post->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-lg m-2">Delete Post</button>
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div>
    @if (session()->has('message'))
        <div>
            <p class="text-center fs-3">{{session()->get('message')}} </p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger text-alert" >
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
        <div class="py-12 bg-light container ">
        <div class="p-6 m-6 bg-white border-b border-gray-200 container shadow">
            <div class="row pl-3 m-3 border-bottom" >
                <h2 class="pt-3 pl-3"> {{$post->title}}</h2>
                <p class="text-muted">By <span class="fw-bold"> {{$post->user->name}} </span>, Created on {{date('jS M Y', strtotime($post->created_at))}}
                    @if($post->created_at != $post->updated_at)  , Edited on {{date('jS M Y', strtotime($post->updated_at))}}
                    @endif
                    </p>
            </div>
            <div class="row py-3 m-3 d-flex justify-content-center ">
                    @if(isset($post->file_path))
                        <div class="col-sm-6 ">
                            <img class="img-fluid" src="{{asset('images/blog/'.$post->file_path)}}" alt="blog post image" style="max-height:75vh">
                        </div>
                        <div class="col-sm-4 p-6">
                            <p class="border-bottom p-3"> {{$post->description}}</p>
                            <form action="/comment" method = "POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Type comment..." name="comment" >
                                    <input type="text" hidden name="postID" value="{{$post->id}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-muted fw-bold m-2"> Comments: </p>
                            @forelse ($comments as $comment)
                                <x-comment :comment="$comment" />
                            @empty <p class="text-muted m-2"> No Comments Yet </p>
                            @endforelse
                        </div>
                    @else
                            <p class="border-bottom p-3"> {{$post->description}}</p>
                            <form action="/comment" method = "POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Type comment..." name="comment" >
                                    <input type="text" hidden name="postID" value="{{$post->id}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-muted fw-bold m-2"> Comments: </p>
                            @forelse ($comments as $comment)
                                <x-comment :comment="$comment" />
                            @empty <p class="text-muted m-2"> No Comments Yet </p>
                            @endforelse
                    @endif
            </div>
            <div class="row p-6">
                        <a href="/post/" class="btn btn-outline-dark btn-lg m-2" >Back To Blog </a>
            </div>
        </div>
    </div>


</div>
@endsection