@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
    .cover-photo {
        width: 100%;
        height: 500px;
        background: url('https://scontent.fcai20-2.fna.fbcdn.net/v/t39.30808-6/462709670_2350913275271614_1226139752216010393_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=86c6b0&_nc_ohc=uTDODkzOY7wQ7kNvwFbfy-S&_nc_oc=AdlGo7nP3iL5Pr46n1laTmDiwq6kLa8oCMEUjqhWbdj6nv1BuLgRG8xXAQcMr6o17_c&_nc_zt=23&_nc_ht=scontent.fcai20-2.fna&_nc_gid=VJ-GDBqTUkleCHVaZN4D2Q&oh=00_AfJ6AQtmicJQ07C78Qv_BC2fBImexQUS6B0ThMZzFORS9A&oe=68298F33') center/cover no-repeat;
        position: relative;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        position: absolute;
        bottom: -75px;
        left: 40px;
        object-fit: cover;
    }

    .profile-header {
        padding-left: 210px;
        padding-top: 20px;
    }

    .nav-tabs-profile .nav-link {
        color: #000;
        font-weight: 500;
    }

    .nav-tabs-profile .nav-link.active {
        border-bottom: 3px solid #0d6efd;
        font-weight: 700;
    }

    .story-card {
        width: 100px;
        height: 180px;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        margin-right: 10px;
    }

    .story-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .post-card img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
    }
</style>

<div class='container'>
    <div class="cover-photo">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" alt="Profile Photo" class="profile-photo">
    </div>

    <div class="container mt-5">
        <div class="profile-header d-flex flex-column flex-md-row align-items-start justify-content-between">
            <div>
                <h3>{{$user->first_name . ' ' . $user->last_name }}</h3>
                <p>{{ $user->friends_count ?? '2.3K' }} friends</p>
            </div>
            <div>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Edit Profile</a>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs nav-tabs-profile mt-4" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="posts-tab" data-bs-toggle="tab" href="#posts" role="tab">Posts</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab">About</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="friends-tab" data-bs-toggle="tab" href="#friends" role="tab">Friends</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="photos-tab" data-bs-toggle="tab" href="#photos" role="tab">Photos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="videos-tab" data-bs-toggle="tab" href="#videos" role="tab">Videos</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="profileTabContent">
            <!-- Posts Tab -->
            <div class="tab-pane fade show active" id="posts" role="tabpanel">
                <!-- Stories -->
                <h5 class="mb-3">Stories</h5>
                <div class="d-flex overflow-auto mb-4">
                    @foreach($stories as $story)
                        <div class="story-card">
                            <img src="{{ $story->media_url }}" alt="Story Image">
                        </div>
                    @endforeach
                </div>

                <!-- Posts -->
                <h5 class="mb-3">Posts</h5>
                @forelse($posts as $post)
                    <div class="card mb-3 post-card">
                        <div class="card-body">
                            <h6 class="card-title mb-1">{{ $user->name }}</h6>
                            <p class="card-text mb-2">{{ $post->content }}</p>
                            @if($post->image_url)
                                <img src="{{ $post->image_url }}" class="img-fluid mb-2" alt="Post Image">
                            @endif
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                @empty
                    <p>No posts to show yet.</p>
                @endforelse
            </div>

            <!-- About Tab -->
            <div class="tab-pane fade" id="about" role="tabpanel">
                <div class="card">
                    <div class="card-header">About</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Friends -->
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <p>Friends section coming soon...</p>
            </div>

            <!-- Photos -->
            <div class="tab-pane fade" id="photos" role="tabpanel">
                <p>No photos uploaded yet.</p>
            </div>

            <!-- Videos -->
            <div class="tab-pane fade" id="videos" role="tabpanel">
                <p>No videos uploaded yet.</p>
            </div>
        </div>
    </div>
</div>
@endsection
