<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Show Post')
@section('active2', 'active')

@section('content')
<div class="container">
	@include('partials._massage')
	<div class="row">
        <div class="col-md-12">
        	<h2>All Posts</h2>
  			<p>You Can See Here Your All Posts</p>

  			 <a style="float: right; margin-bottom: 2%;" href="{{ url(url('posts/create')) }}" class="btn btn-primary btn-lg">Create New Post</a>

        <table class="table table-bordered">
        	<thead class="thead-inverse">
			    <tr class="info">
			      <th>#</th>
			      <th>Post Title</th>
			      <th>Post Description</th>
			      <th>Create Date</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
			<?php $i=1;  ?>
           	@foreach ($AllPosts as $post)
						
						<tr>
							<th>{{ $i }}</th>
							<td>{{ $post->title }}</td>
							<td>{{ substr($post->body, 0, 50) }}{{ strlen($post->body) > 50 ? "..." : "" }}</td>
							<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
							<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a></td>
						</tr>
				<?php $i++; ?>
			@endforeach
			</tbody>
			</table>
			

			
        </div>
    </div>
</div>
@endsection