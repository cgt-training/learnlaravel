<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
        <br><br><br><br><br>
            <h2>All Permissions</h2>
            <p>You Can See Here Your All Permission.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>Permission Name</th>
                  <th>Label Name</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($allpermission as $per_mission)
                        
                <tr>
                    <th>{{ $per_mission->id }}</th>
                    <td>{{ $per_mission->name }}</td>
                    <td>{{ $per_mission->label }}</td>
                    <td>{{ date('M j, Y', strtotime($per_mission->created_at)) }}</td>
                    <td> 
                    
                    {{ Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $per_mission->id]]) }}
                    <a href="{{ route('permissions.edit', $per_mission->id) }}" class="btn btn-primary btn-sm">Edit</a>
	 				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
			        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>

        <div class="col-md-3">
        <br><br><br><br><br>
        <div class="panel panel-default">
                <div class="panel-heading">
                    Permission
                </div>

                <div class="panel-body">
              
                @if(isset($permission))
                
                   	{!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}

                	{{ Form::label('name','Permission Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('label','Permission Label',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::text('label',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Update Permission', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                    {!! Form::open(array('route' => 'permissions.store', 'data-parsley-validate' => '')) !!}
                   	
				  <!-- text input field -->
				 
				  {{ Form::label('name','Permission Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('name','',array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('label','Permission Label',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::text('label','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Create Permission', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}	
			{{ Form::close() }}
			@endif 
                </div>
            </div>
        </div>



    </div>

@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection