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
			
  			 <a style="float: right; margin-bottom: 2%;" href="{{ url('/registeradmin') }}" class="btn btn-primary btn-lg">Create New User</a>
  			

        <table class="table table-bordered">
        	<thead class="thead-inverse">
			    <tr class="info">
			      <th>#</th>
			      <th>User Name</th>
			      <th>Email</th>
			      <th>Create Date</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
           	@foreach ($Allusers as $user)
						
						<tr>
							<th>{{ $user->id }}</th>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
							<td style="text-align: center;">

							<!-- <a href="{{ route('postadmin.show', $user->id) }}" class="btn btn-default btn-sm">View</a>  -->

							
							<!-- <a href="{{ route('postadmin.edit', $user->id) }}" class="btn btn-default btn-sm">Edit</a> -->
							
						{{ Form::open(['method' => 'DELETE', 'route' => ['userdestroy', $user->id]]) }}
			 				{{ Form::submit('Delete User', ['class' => 'btn btn-danger btn-sm']) }}
						{{ Form::close() }}
										
							</td>
						</tr>
			@endforeach
			<tr>
				<td colspan="5" style="text-align: center;">
				{{ $Allusers->links() }}</td>
			</tr>
			</tbody>
			</table>
			

			
        </div>
    </div>

@endsection

<style type="text/css">
	.my-select{width: 10% !important; position: absolute !important;}
</style>