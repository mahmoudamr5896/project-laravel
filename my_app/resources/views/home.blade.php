@extends('layouts.app')

@section('content')

<style>
    body {
      background-color: #18191a;
      color: white;
    }
    .sidebar {
      height: 100vh;
      overflow-y: auto;
    }
    .icon-label {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
    }
    .icon-label:hover {
      background-color: #3a3b3c;
    }
    .contact-img {
      width: 32px;
      height: 32px;
      border-radius: 50%;
    }
    .divider {
      border-bottom: 1px solid #3e4042;
      margin: 10px 0;
    }
    .story-scroll::-webkit-scrollbar {
    display: none;
  }.col-3.sidebar-left {
      margin-left: 0; /* Remove left margin */
    }
    .col-3.sidebar-right {
      margin-right: 0; /* Remove right margin */
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar -->
    <div class="col-3  sidebar p-3 m-0" >
      <div class="icon-label"><img src="https://via.placeholder.com/32" class="contact-img"> Mahmoud Ezat</div>
      <div class="icon-label"><i class="bi bi-globe2 text-primary"></i> Meta AI</div>
      <div class="icon-label"><i class="bi bi-people-fill text-info"></i> Friends</div>
      <div class="icon-label"><i class="bi bi-clock text-primary"></i> Memories</div>
      <div class="icon-label"><i class="bi bi-bookmark-fill text-pink"></i> Saved</div>
      <div class="icon-label"><i class="bi bi-people text-primary"></i> Groups</div>
      <div class="icon-label"><i class="bi bi-play-btn-fill text-info"></i> Video</div>
      <div class="icon-label"><i class="bi bi-shop text-primary"></i> Marketplace</div>
      <div class="icon-label"><i class="bi bi-newspaper text-info"></i> Feeds</div>
      <div class="icon-label"><i class="bi bi-calendar-event text-danger"></i> Events</div>
      <div class="icon-label"><i class="bi bi-chevron-down"></i> See more</div>

      <div class="divider"></div>
      <p class="text-muted small">Your Shortcuts</p>
      <div class="icon-label"><img src="https://via.placeholder.com/32" class="contact-img"> سكان الحي الثالث شرق النيل</div>
    </div>

    <!-- Center Area (Optional main content) -->
    <div class="col-6 p-5">

        <!-- Post Input (Triggers Modal) -->
<div class="bg-dark text-white p-4 rounded mb-3">
    <div class="d-flex align-items-center mb-3">
        <img src="https://via.placeholder.com/40" class="rounded-circle me-2" />
        
        <!-- Input triggers modal -->
        <input type="text" 
               class="form-control bg-secondary text-white" 
               placeholder="What's on your mind, Mahmoud?" 
               data-bs-toggle="modal" 
               data-bs-target="#createPostModal" />
    </div>
    <div class="d-flex justify-content-between text-muted my-2">
    <button class="btn btn-dark text-white d-flex align-items-center">
        <i class="fas fa-video text-danger me-2"></i> Live Video
    </button>
    <button class="btn btn-dark text-white d-flex align-items-center">
        <i class="fas fa-photo-video text-success me-2"></i> Photo/Video
    </button>
    <button class="btn btn-dark text-white d-flex align-items-center">
        <i class="fas fa-smile text-warning me-2"></i> Feeling/Activity
    </button>
</div>

</div>


<!-- ✅ Modal for Creating Post -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <!-- Move form start to wrap header + body -->
      <form id="postForm" method="POST" action="{{ url('/posts') }}">
        @csrf

        <div class="modal-header border-0">
          <h5 class="modal-title" id="createPostModalLabel">Create post</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2"/>
            <div>
              <strong>{{ auth()->user()->name ?? 'Guest' }}</strong><br>
              <small>
                <i class="fas fa-lock"></i>
                <select name="visibility" class="form-select bg-dark text-white mt-1">
                  <option value="public">Public</option>
                  <option value="friends">Friends</option>
                  <option value="private">Only me</option>
                </select>
              </small>
            </div>
          </div>

          <!-- Post text -->
          <textarea name="text_content"
                    class="form-control bg-dark text-white border-0"
                    rows="3"
                    placeholder="What's on your mind, {{ auth()->user()->name ?? 'Guest' }}?">{{ old('text_content') }}</textarea>

          <!-- Post type -->
          <select name="post_type" class="form-select bg-dark text-white mt-2">
            <option value="text">Text</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
          </select>

          <!-- Media URL -->
          <input type="url"
                 name="media_url"
                 class="form-control bg-dark text-white mt-2"
                 placeholder="Media URL (Optional)"
                 value="{{ old('media_url') }}">

          <!-- display validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger mt-2">
              <ul class="mb-0">
                @foreach ($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        <div class="modal-footer border-0">
          <!-- trigger submission -->
          <button type="button" class="btn btn-secondary w-100" onclick="submitPost()">Post</button>
        </div>
      </form>

    </div>
  </div>
</div>


        <!-- Stories Section -->
        <div class="position-relative">
        <div class="d-flex overflow-auto px-2 story-scroll" style="gap: 10px; scroll-behavior: smooth;" id="storyContainer">
            <!-- Upload Story Form -->
<form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data" class="bg-dark rounded text-white text-center p-2" style="width: 100px; flex: 0 0 auto;">
    @csrf
    <label for="storyUpload" style="cursor: pointer;">
        <img src="https://via.placeholder.com/100x140" class="w-100 rounded-top" style="height: 140px; object-fit: cover;">
        <div class="pt-2 small">Upload</div>
    </label>
    <input type="file" name="media" id="storyUpload" class="d-none" onchange="this.form.submit()">
</form>

           
    @foreach($stories as $story)
    <div class="bg-dark rounded text-white text-center" style="width: 100px; flex: 0 0 auto;">
        @if ($story->media_type == 'video')
            <video src="{{ $story->media_url }}" class="w-100 rounded-top" style="height: 140px; object-fit: cover;" controls></video>
        @else
            <img src="{{ $story->media_url }}" class="w-100 rounded-top" style="height: 140px; object-fit: cover;">
        @endif
        <div class="position-relative">
            <img src="{{ $story->user->profile_pic ?? 'https://via.placeholder.com/40' }}" class="rounded-circle position-absolute" style="top: -20px; left: 30px; border: 3px solid #1877f2;">
        </div>
        <div class="pt-4 pb-2 small">{{ $story->user->first_name . ' ' . $story->user->last_name }}</div>
    </div>
    @endforeach
  </div>
        <!-- Right Scroll Arrow -->
        <button onclick="scrollStories()" class="btn btn-dark position-absolute top-50 end-0 translate-middle-y" style="z-index: 10;">
            <i class="fas fa-chevron-right"></i>
        </button>
        </div>

        <section class="mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                     


@foreach ($posts as $post)
<div class="card bg-dark text-white rounded shadow-sm mb-3 border-0">

    <!-- Post Header -->
    <div class="d-flex align-items-center p-3 pb-0">
        <img src="https://i.imgur.com/yTFUilP.jpg" alt="avatar" class="rounded-circle me-2" width="40" height="40">
        <div>
            <strong class="d-block mb-0">{{ $post->user->first_name . ' ' . $post->user->last_name  }}</strong>
            <small class="text-muted">{{ $post->created_at->diffForHumans() }} • <i class="fas fa-globe-americas"></i></small>
        </div>
        <div class="ms-auto text-end">
            <i class="fas fa-ellipsis-h text-muted"></i>
        </div>
    </div>

    <!-- Post Content -->
    <div class="px-3 pb-2" dir="rtl">
        @if (!empty($post->text_content))
            <p class="mt-2 mb-2 fs-6 lh-base">{{ $post->text_content }}</p>
        @endif

        @if ($post->post_type == 'image' && !empty($post->media_url))
            <img src="{{ $post->media_url }}" alt="Post Image" class="img-fluid rounded mt-2">
        @endif

        @if ($post->post_type == 'video' && !empty($post->media_url))
            <div class="ratio ratio-16x9 mt-2">
                <iframe src="{{ $post->media_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif
    </div>

    <!-- Reactions Summary -->
    <div class="px-3 d-flex justify-content-between align-items-center text-muted small mb-1">
        <div>

            <span class="me-2">❤️ 😆</span>
            <span class='text-white'>{{ $post->likes_count ?? 108 }}</span>
        </div>
        <div>
            <span class=" text-white">{{ $post->comments->count() }} Comments</span>
            <span class="ms-2 text-white"  >{{ $post->shares_count ?? 10 }} Shares</span>
        </div>
    </div>

    <hr class="my-1 text-secondary" style="opacity: 0.1;">

    <!-- Action Buttons -->
    <div class="d-flex justify-content-around px-3 pb-2 border-bottom">
        <button class="btn btn-sm btn-dark w-100 text-white border-0">
            <i class="bi bi-hand-thumbs-up me-1"></i>Like
        </button>
        <button class="btn btn-sm btn-dark w-100 text-white border-0" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}">
            <i class="bi bi-chat-left-text me-1"></i>Comment
        </button>
        <button class="btn btn-sm btn-dark w-100 text-white border-0">
            <i class="bi bi-share me-1"></i>Share
        </button>
    </div>

    <!-- Modal for Comments -->
    <div class="modal fade" id="commentsModal-{{ $post->id }}" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
            <div class="modal-content bg-dark text-white border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="commentsModalLabel">{{ $post->user->first_name . ' ' . $post->user->last_name }} 's Post</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Post Content Preview -->
                    <p dir="rtl" class="mb-3">{{ $post->text_content }}</p>

                    <!-- Comments List -->
                    <div class="comments-list">
                        @foreach ($post->comments as $comment)
                            <div class="bg-secondary rounded p-2 mb-2">
                                <strong>{{ $post->user->first_name . ' ' . $post->user->last_name }}</strong>
                                <p class="mb-1">{{ $comment->comment }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Comment Form at the bottom -->
                <div class="modal-footer border-0">
                    <form action="{{ route('comments.store') }}" method="POST" class="w-100 d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="text" name="comment" class="form-control me-2 bg-dark text-white border-secondary" placeholder="Comment as {{ Auth::user()->name }}" required>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endforeach


@foreach ($posts as $post)
    <div class="post">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <p><strong>Posted by:</strong> {{ $post->user->first_name . ' ' . $post->user->last_name }}</p>
        </div>
@endforeach

                    </div>
                </div>
            </div>
        </section>



    </div>

    <!-- Right Sidebar -->
    <div class="col-3 sidebar   p-3" style="margin: right 0px;">
      <p class="text-muted small">Sponsored</p>
      <div class="mb-3">
        <img src="https://via.placeholder.com/300x100" class="w-100 rounded mb-1">
        <div class="small">Finish signing up for Azure<br><span class="text-muted">azure.microsoft.com</span></div>
      </div>
      <div class="mb-3">
        <img src="https://via.placeholder.com/300x100" class="w-100 rounded mb-1">
        <div class="small">City Building Hero Battle<br><span class="text-muted">heroesofhistorygame.com</span></div>
      </div>

      <div class="divider"></div>
      <p class="text-muted small">Friend Requests <a href="#" class="float-end text-decoration-none">See all</a></p>
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/40" class="contact-img me-2">
        <div>
          <strong>Abraham Hassan</strong><br>
          <small class="text-muted">110 mutual friends</small>
        </div>
      </div>
      <div class="d-flex gap-2 mb-3">
        <button class="btn btn-primary btn-sm">Confirm</button>
        <button class="btn btn-secondary btn-sm">Delete</button>
      </div>

      <div class="divider"></div>
      <p class="text-muted small">Birthdays</p>
      <p><i class="bi bi-gift-fill text-danger me-2"></i>حمزة وادم have their birthdays today.</p>

      <div class="divider"></div>
      <p class="text-muted small">Contacts</p>
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/32" class="contact-img me-2"><span>Ismail Taya</span>
      </div>
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/32" class="contact-img me-2"><span>Samir Hafez Elwan</span>
      </div>
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/32" class="contact-img me-2"><span>Walid Ramadan</span>
      </div>
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/32" class="contact-img me-2"><span>Ali B. Yahya</span>
      </div>
    </div>
    
  </div>
</div>
<script>
  function scrollStories() {
    const container = document.getElementById('storyContainer');
    container.scrollBy({ left: 150, behavior: 'smooth' });
  }

  function submitPost() {
    document.getElementById('postForm').submit();
  }
</script>


@endsection
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