@extends('layouts.app')

@section('title', 'posts')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control"name='title' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">description</label>
    <input type="text"  class="form-control" name='description' id="exampleInputPassword1" placeholder="Password">
  </div>
  <!-- <input type="text" name="posted_by" value="{{ $user->name }}"> -->
  <button type="submit" class="btn btn-primary mt-5">Create</button>
</form>


@endsection