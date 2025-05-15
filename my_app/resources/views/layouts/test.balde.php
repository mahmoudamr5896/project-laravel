<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
        </li>

        <!-- Account Dropdown -->
        @if (Route::has('login'))
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('posts.create') }}">Create Post</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Log in</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
              </li>
            @endif
          @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>


<!-- Post Card -->
<div class="bg-dark text-white rounded p-3 mb-3">

  <!-- Post Header -->
  <div class="d-flex justify-content-between align-items-start">
    <div class="d-flex align-items-center">
      <img src="" class="rounded-circle me-2" width="45" height="45" />
      <div>
        <strong>{{ $post->user->name }}</strong>
        <div class="text-muted small">
          {{ $post->created_at->diffForHumans() }} · <i class="fas fa-globe"></i>
        </div>
      </div>
    </div>
    <div>
      <i class="fas fa-ellipsis-h text-muted"></i>
    </div>
  </div>

  <!-- Post Content -->
  <div class="mt-3" dir="rtl">
    {!! nl2br(e($post->content)) !!}
  </div>

  <!-- Reactions -->
  <div class="mt-3 d-flex align-items-center justify-content-between text-muted small">
    <div>
      <img src="/icons/like.svg" width="18" /> 
      <img src="/icons/love.svg" width="18" /> 
      <img src="/icons/care.svg" width="18" /> 
      محمود ناجح, {{ $post->likes->first()->user->name ?? '' }} and {{ $post->likes->count() - 1 }} others
    </div>
    <div>
      {{ $post->comments->count() }} comments
    </div>
  </div>

  <hr class="bg-secondary" />

  <!-- Buttons -->
  <div class="d-flex justify-content-around text-center">
    <button class="btn btn-dark text-white w-100">
      <i class="far fa-thumbs-up me-1"></i> Like
    </button>
    <button class="btn btn-dark text-white w-100">
      <i class="far fa-comment me-1"></i> Comment
    </button>
    <button class="btn btn-dark text-white w-100">
      <i class="fas fa-share me-1"></i> Share
    </button>
  </div>
</div>
 <!-- Create Story -->
            <!-- <div class="bg-dark rounded text-white text-center" style="width: 100px; flex: 0 0 auto;">
            <img src="https://via.placeholder.com/100x140" class="w-100 rounded-top" style="height: 140px; object-fit: cover;">
            <div class="position-relative">
                <img src="https://via.placeholder.com/40" class="rounded-circle position-absolute" style="top: -20px; left: 30px; border: 3px solid #18191a;">
            </div>
            <div class="pt-4 pb-2">
                <i class="fas fa-plus-circle text-primary"></i>
                <div class="small">Create story</div>
            </div>
            </div> -->

            <!-- Story Cards -->
            <!-- @foreach($stories as $story)
            <div class="bg-dark rounded text-white text-center" style="width: 100px; flex: 0 0 auto;">
            <img src="{{ $story->image_url }}" class="w-100 rounded-top" style="height: 140px; object-fit: cover;">
            <div class="position-relative">
                <img src="{{ $story->user->profile_pic }}" class="rounded-circle position-absolute" style="top: -20px; left: 30px; border: 3px solid #1877f2;">
            </div>
            <div class="pt-4 pb-2 small">{{ $story->user->name }}</div>
            </div>
            @endforeach -->
            <!-- Top Section: Create Post -->
        <div class="bg-dark text-white p-4 rounded mb-3">
        <div class="d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" />
            <input type="text" class="form-control bg-secondary text-white" placeholder="What's on your mind, Mahmoud?" />
        </div>
        <div class="d-flex justify-content-between text-muted">
            <button class="btn btn-dark text-white">
            <i class="fas fa-video text-danger"></i> Live video
            </button>
            <button class="btn btn-dark text-white">
            <i class="fas fa-photo-video text-success"></i> Photo/video
            </button>
            <button class="btn btn-dark text-white">
            <i class="fas fa-smile text-warning"></i> Feeling/activity
            </button>
        </div>
        </div>
        <!-- ✅ Modal for Creating Post -->
<!-- <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="createPostModalLabel">Create post</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="d-flex align-items-center mb-3">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-2" />
          <div>
            <strong>Mahmoud Ezat</strong><br>
            <small><i class="fas fa-lock"></i> Only me</small>
          </div>
        </div>

        <textarea class="form-control bg-dark text-white border-0" rows="3" placeholder="What's on your mind, Mahmoud?"></textarea>

        Add to your post
        <div class="d-flex justify-content-between mt-3">
          <button class="btn btn-dark text-white"><i class="fas fa-image text-success"></i></button>
          <button class="btn btn-dark text-white"><i class="fas fa-user-friends text-primary"></i></button>
          <button class="btn btn-dark text-white"><i class="fas fa-smile text-warning"></i></button>
          <button class="btn btn-dark text-white"><i class="fas fa-gift text-info"></i></button>
        </div>

      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary w-100">Post</button>
      </div>
    </div>
  </div>
</div> -->
<!-- <form method="POST" action="/posts">
    @csrf

    <textarea name="text_content" placeholder="What's on your mind?" rows="3"></textarea>

    <select name="post_type">
        <option value="text">Text</option>
        <option value="image">Image</option>
        <option value="video">Video</option>
    </select>

    <input type="url" name="media_url" placeholder="Media URL (Optional)">

    <select name="visibility">
        <option value="public">Public</option>
        <option value="friends">Friends</option>
        <option value="private">Private</option>
    </select>

    <button type="submit">Post</button>
</form> -->
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
@foreach ($posts as $post)
                        <div class="card mb-4 bg-dark text-white rounded shadow-sm">
                            <div class="card-body">
                                <!-- Post Header -->
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" alt="avatar" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">{{ $post['posted_by'] }}</h6>
                                        <small class="text-muted">{{ $post['created_at'] }}</small>
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <h6 class="text-info">Header: {{ $post['title'] }}</h6>
                                <p>{{ $post['description'] }}</p>

                                <!-- Last Comment -->
                                @if ($post->comments->count())
                                    @php $lastComment = $post->comments->last(); @endphp
                                    <div class="border rounded p-2 mb-2 bg-secondary">
                                        <strong>{{ $lastComment->user->name ?? 'Anonymous' }}:</strong>
                                        <p>{{ $lastComment->comment }}</p>
                                        <small class="text-muted">{{ $lastComment->created_at->diffForHumans() }}</small>

                                        @if (auth()->check() && $lastComment->user_id == auth()->id())
                                        <div class="mt-2">
                                            <a href="{{ route('comments.edit', $lastComment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('comments.destroy', $lastComment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-link p-0">Show All Comments ({{ $post->comments->count() }})</a>
                                @else
                                    <p class="text-muted">No comments yet.</p>
                                @endif

                                <!-- Comment Form -->
                                <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Submit Comment</button>
                                </form>
                            </div>

                            <!-- Reactions Row -->
                            <div class="card-footer bg-dark border-top d-flex justify-content-around text-muted">
                                <button class="btn btn-sm btn-outline-light"><i class="bi bi-hand-thumbs-up"></i> Like</button>
                                <button class="btn btn-sm btn-outline-light"><i class="bi bi-chat"></i> Comment</button>
                                <button class="btn btn-sm btn-outline-light"><i class="bi bi-share"></i> Share</button>
                            </div>
                        </div>
                        @endforeach


                        <!-- @extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Your Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>

                    Add other user fields as necessary
                    <div class="row mb-3">
                        <label for="created_at" class="col-md-4 col-form-label text-md-end">Account Created On</label>
                        <div class="col-md-6">
                            <p>{{ $user->created_at->format('d-m-Y') }}</p>
                        </div>
                    </div>

                    Link to edit profile or other actions
                    <div class="mt-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->