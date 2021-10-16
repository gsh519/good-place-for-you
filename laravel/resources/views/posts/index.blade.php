@extends('frame')

@section('title', 'トップページ')

@section('content')
@include('nav')
<div class="container">
  <div class="row">
    @foreach($posts as $post)
    <div class="card col-md-3 mt-4 mb-4 p-0">
      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
        <img src="https://mdbootstrap.com/img/new/standard/nature/111.jpg" class="img-fluid" />
        <a href="#!">
          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
        </a>
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ $post->place_name }}</h5>
        <h5 class="card-title">
          {{ $post->good_point }}
        </h5>
        <p class="card-text">
          {{ $post->user->name }}
        </p>
        <p class="card-text">
          {{ $post->created_at }}
        </p>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
