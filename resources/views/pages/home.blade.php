<!-- Stored in resources/views/child.blade.php -->
@extends('layouts.pages')

@section('title', 'Home')
@section('active1', 'active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
              <div class="jumbotron">
                <h1>Welcome to My Blog!</h1>
                <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read my popular post!</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
              </div>
        </div>
    </div>

      @foreach ($AllPosts as $post)
          <div class="row">
            <div class="col-md-8">
                  <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p class="lead">{{ substr($post->body, 0, 85) }}{{ strlen($post->body) > 85 ? "..." : "" }}</p>
                    <p><a class="btn btn-primary btn-lg" href="{{url('/blog/'.$post->slug)}}" role="button">Read More</a></p>
                  </div>
            </div>
        </div>
      @endforeach

</div>
@endsection