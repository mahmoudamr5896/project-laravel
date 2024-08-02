@extends('layouts.app')

@section('title', 'posts')

@section('content')

<div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $posts['title'] }}
</h5>
    <p class="card-text">{{ $posts['description'] }}</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
@endsection
