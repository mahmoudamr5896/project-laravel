@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Hello User') }}</div>
                @if($user)
                    <h1>Welcome, {{ $user->name }}!</h1>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Post Create Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="post-box p-4 bg-white rounded shadow-sm">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control"name='description' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <textarea name="title" class="form-control mb-3 p-3" rows="3" placeholder="Write something..."></textarea>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-light"><i class="fas fa-video text-danger"></i> Live</button>
                            <button type="button" class="btn btn-light"><i class="fas fa-image text-success"></i> Photo</button>
                            <button type="button" class="btn btn-light"><i class="fas fa-smile text-warning"></i> Recommend</button>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Posts Section -->
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h1>Posts</h1>
                @foreach ($posts as $post)
                <div class="comment mt-4 text-justify float-left">
                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>{{ $post['posted_by'] }}</h4>
                    <span>{{ $post['created_at'] }}</span>
                    <br>
                    <h6>Header: {{ $post['title'] }}</h6>
                    <p>{{ $post['description'] }}</p>
                </div>
                @endforeach
            </div>

            <!-- Comment Section -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="algin-form">
                    <div class="form-group">
                        <h4>Send feedback</h4>
                        <label for="message">Message</label>
                        <textarea name="msg" id="msg" cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="fullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <p class="text-secondary">If you have a <a href="#" class="alert-link">gravatar account</a> your address will be used to display your profile picture.</p>
                    </div>
                    <div class="form-inline">
                        <input type="checkbox" name="check" id="checkbx" class="mr-1">
                        <label for="subscribe">Subscribe me to the newsletter</label>
                    </div>
                    <div class="form-group">
                        <button type="button" id="post" class="btn btn-primary">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
