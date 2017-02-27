<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('content')

	@include('partials._massage')
	<div class="row">
        <div class="col-md-10 col-md-offset-2">
        <br><br><br>
        	<h2>All Posts</h2>
  			<p>You Can See Here Your All Posts</p>

  			<?php if(!isset($page)) { $page = ''; } ?>

  			<!-- {{ Form::model($page, array('method' => 'put', 'url' => "pagination", 'name' => "frm_select_page")) }}

  			{{ Form::select('totalrecords', ['5' => '5', '10' => '10', '20' => '20', '50' => '50', '100' => '100'], null, array('class' => 'form-control my-select', 'name' => 'totalrecords', "onchange" => "document.frm_select_page.submit();")) }}

			{!! Form::close() !!} -->
			@if (Auth::guard('admin')->user()->can('create_topic'))
  			 <a style="float: right; margin-bottom: 2%;" href="{{ route('postadmin.create') }}" class="btn btn-primary btn-lg">Create New Post</a>
  			@endif

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
           	@foreach ($AllPosts as $post)
						
						<tr>
							<th>{{ $post->id }}</th>
							<td>{{ $post->title }}</td>
							<td>{{ substr($post->body, 0, 50) }}{{ strlen($post->body) > 50 ? "..." : "" }}</td>
							<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
							<td style="text-align: center;">

							<a href="{{ route('postadmin.show', $post->id) }}" class="btn btn-default btn-sm">View</a> 

							@if (Auth::guard('admin')->user()->can('edit_topic'))
							<a href="{{ route('postadmin.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
							@endif
										
							</td>
						</tr>
			@endforeach
			<tr>
				<td colspan="5" style="text-align: center;">
				{{ $AllPosts->links() }}</td>
			</tr>
			</tbody>
			</table>
			

			
        </div>
    </div>

@endsection

<style type="text/css">
	.my-select{width: 10% !important; position: absolute !important;}
</style>