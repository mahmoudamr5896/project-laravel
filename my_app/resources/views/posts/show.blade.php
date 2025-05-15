@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Post Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ $post->title }}</h5>
                    <small>Posted by: {{ $post->posted_by }} on {{ $post->created_at->format('F j, Y') }}</small>
                </div>
                <div class="card-body">
                    <p>{{ $post->description }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section mb-4">
                <h5>{{ $post->comments->count() }} Comments</h5>

                @foreach ($post->comments as $comment)
                    <div class="comment mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center">
                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($comment->user->email))) }}?d=identicon" alt="User" class="rounded-circle" width="40" height="40">
                            <div class="ml-3">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted"> - {{ $comment->created_at->diffForHumans() }}</small>
                                <p class="mt-2">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Comment Form -->
            @if(auth()->check())
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            @else
                <p>Please <a href="{{ route('login') }}">log in</a> to comment.</p>
            @endif

        </div>
    </div>
</div>
@endsection
