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

                    <!-- Show Last Comment -->
                    <div class="mt-3">
                        <div>
                           <h5>Last Comment:</h5>
                             @if ($post->comments->count())
                            @php
                                $lastComment = $post->comments->last();
                            @endphp
                            <div class="border p-2 mb-2 rounded">
                                <strong>{{ $lastComment->user->name ?? 'Anonymous' }}:</strong>
                                <p>{{ $lastComment->comment }}</p>
                                <small>{{ $lastComment->created_at->diffForHumans() }}</small>

                                <!-- Edit/Delete Buttons -->
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
                            <!-- Button to show all comments -->
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-link p-0">Show All Comments ({{ $post->comments->count() }})</a>
                        @else
                            <p>No comments yet.</p>
                        @endif  
                        </div>
                     
                    </div>

                    <!-- Form to add comment -->
                    <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post['id'] }}">

                        <div class="form-group">
                            <label for="comment">Add Comment:</label>
                            <textarea name="comment" class="form-control" rows="2" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm mt-2">Submit Comment</button>
                    </form>

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
@foreach ($posts as $post)
<div class="card mb-4 bg-dark text-white rounded shadow-sm">
    <div class="card-body">
        <!-- Post Header -->
        <div class="d-flex align-items-center mb-2">
            <img src="https://i.imgur.com/yTFUilP.jpg" alt="avatar" class="rounded-circle me-2" width="40" height="40">
            <div>
                <h6 class="mb-0">{{ $post->user->name ?? 'Anonymous' }}</h6>
                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>

        <!-- Post Text -->
        @if (!empty($post->text_content))
            <p class="mt-2" dir="rtl">{{ $post->text_content }}</p>
        @endif

        <!-- If Post Type is IMAGE -->
        @if ($post->post_type == 'image' && !empty($post->media_url))
            <img src="{{ $post->media_url }}" alt="Post Image" class="img-fluid rounded mt-2">
        @endif

        <!-- If Post Type is VIDEO -->
        @if ($post->post_type == 'video' && !empty($post->media_url))
            <div class="ratio ratio-16x9 mt-2">
                <iframe src="{{ $post->media_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        <!-- Comments -->
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
            <input type="hidden" name="post_id" value="{{ $post->id }}">
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
@foreach ($posts as $post)
<div class="card bg-dark text-white rounded shadow-sm mb-3 border-0">

    <!-- Post Header -->
    <div class="d-flex align-items-center p-3 pb-0">
        <img src="https://i.imgur.com/yTFUilP.jpg" alt="avatar" class="rounded-circle me-2" width="40" height="40">
        <div>
            <strong class="d-block mb-0">{{ $post->user->name ?? 'Anonymous' }}</strong>
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
            <span class="me-2"><i class="fas fa-thumbs-up text-primary"></i> 😆 ❤️</span>
            <span>108</span>
        </div>
        <div>
            <span>{{ $post->comments->count() }} comments</span>
            <span class="ms-2">10 shares</span>
        </div>
    </div>

    <hr class="my-1 text-secondary" style="opacity: 0.1;">

    <!-- Action Buttons -->
    <div class="d-flex justify-content-around px-3 pb-2">
        <button type="button" class="btn btn-sm btn-dark w-100 text-white border-0" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}"><i class="bi bi-hand-thumbs-up me-1"  type="button" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}"></i>Like</button>
        <!-- <button data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $post->id }}"  class="btn btn-link p-0 text-start" >
    Show All Comments ({{ $post->comments->count() }})
</button> -->
        <button class="btn btn-sm btn-dark w-100 text-white border-0"><i class="bi bi-chat me-1"></i>Comment</button>
        <button class="btn btn-sm btn-dark w-100 text-white border-0"><i class="bi bi-share me-1"></i>Share</button>
    </div>
<!-- Modal for Comments -->
<div class="modal fade" id="commentsModal-{{ $post->id }}" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
    <div class="modal-content bg-dark text-white border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="commentsModalLabel">{{ $post->user->name }}'s Post</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Post Content Preview -->
        <p dir="rtl" class="mb-3">{{ $post->text_content }}</p>

        <!-- Comments List -->
        <div class="comments-list">
          @foreach ($post->comments as $comment)
            <div class="bg-secondary rounded p-2 mb-2">
              <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
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