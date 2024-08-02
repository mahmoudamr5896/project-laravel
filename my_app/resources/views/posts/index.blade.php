@extends('layouts.app')

@section('title', 'posts')

@section('content')
<div class="container mt-5">
    <div class="container justify-content-center">
    <a class='btn btn-success' href="{{ route('posts.create')}}">Create Post </a>

    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>posted By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['title'] }}</td>
                    <td>{{ $user['posted_by'] }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('posts.show', $user->id) }}" class="btn btn-info btn-sm">show</a>
                        <form action="{{ route('posts.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
