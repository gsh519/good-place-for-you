@extends('frame')

@section('title', 'トップページ')

@section('content')
@include('nav')

<div class="container">
  <div class="row">
    @foreach($posts as $post)
    @include('posts.card')
    @endforeach
  </div>
</div>

@endsection
