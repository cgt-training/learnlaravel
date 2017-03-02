<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('content')
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> All Posts</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Posts</li>						  	
					</ol>
				</div>
			</div>

	@include('partials._massage')
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
        
  			<?php /* @if (Auth::guard('admin')->user()->can('create_post')) */ ?>
  			 <a style="float: right; margin-bottom: 2%;" href="{{ route('postadmin.create') }}" class="btn btn-primary btn-lg">Create New Post</a>
  			<?php /* @endif */ ?>

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
							

							
							<a href="{{ route('postadmin.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
							
										
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
</section>
</section>
@endsection

<style type="text/css">
	.my-select{width: 10% !important; position: absolute !important;}
</style>