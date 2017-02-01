<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Create Post')
@section('category', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
 <div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h2>All Category</h2>
            <p>You Can See Here Your All Categories.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>Category Name</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($allcat as $cat)
                        
                        <tr>
                            <th>{{ $cat->id }}</th>
                            <td>{{ $cat->cat_name }}</td>
                            <td>{{ date('M j, Y', strtotime($cat->created_at)) }}</td>
                            <td> 
                            
                            
                            {{ Form::open(['method' => 'DELETE', 'route' => ['catogories.destroy', $cat->id]]) }}
                            <a href="{{ route('catogories.edit', $cat->id) }}" class="btn btn-primary btn-sm">Edit</a>
   			 				{{ Form::submit('Delete Post', ['class' => 'btn btn-danger btn-sm']) }}
							{{ Form::close() }}
                            </td>
                        </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>

        <div class="col-md-4">
        <div class="panel panel-default">
                <div class="panel-heading">
                    Category
                </div>

                <div class="panel-body">
               
                @if(isset($category))
                 <!-- {{$category}} -->
                   	{!! Form::model($category, ['route' => ['catogories.update', $category->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}

                	{{ Form::label('cat_name','Category Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('cat_name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Update Category', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                    {!! Form::open(array('route' => 'catogories.store', 'data-parsley-validate' => '')) !!}
                   	
				  <!-- text input field -->
				 
				  {{ Form::label('cat_name','Category Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('cat_name','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Create Category', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}	
			{{ Form::close() }}
			@endif 
                </div>
            </div>
        </div>



    </div>
</div>
@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection