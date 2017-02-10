<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Create Tag')
@section('tag', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
 <div class="container">
    
    <div class="row">
        <div class="col-md-8">
            <h2>All Tags</h2>
            <p>You Can See Here Your All Tags.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>Tag Name</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($alltag as $tag)
                        
                        <tr>
                            <th>{{ $tag->id }}</th>
                            <td>{{ $tag->name }}</td>
                            <td>{{ date('M j, Y', strtotime($tag->created_at)) }}</td>
                            <td> 
                            
                            
                            {{ Form::open(['method' => 'DELETE', 'route' => ['tags.destroy', $tag->id]]) }}
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm">Edit</a>
   			 				{{ Form::submit('Delete tag', ['class' => 'btn btn-danger btn-sm']) }}
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
                    Tags
                </div>

                <div class="panel-body">
               
                @if(isset($tagset))
                 
                  {!! Form::model($tagset, ['route' => ['tags.update', $tag->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
                	
                  {{ Form::label('name','Tag Name',array('id'=>'','class'=>'control-label')) }}
				          {{ Form::text('name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
        				  <!-- submit buttons -->
        				 {{ Form::submit('Update Tag', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                  {!! Form::open(array('route' => 'tags.store', 'data-parsley-validate' => '')) !!}
                   	
        				  <!-- text input field -->
        				  {{ Form::label('name','Tag Name',array('id'=>'','class'=>'control-label')) }}
        				  {{ Form::text('name','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
        				 <!-- submit buttons -->
        				 {{ Form::submit('Create Tag', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}	
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