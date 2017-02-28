<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
        <br><br><br><br><br>
            <h2>All Roles</h2>
            <p>You Can See Here Your All Roles.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>Role Name</th>
                  <th>Label Name</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($allrole as $ro_le)
                        
                <tr>
                    <th>{{ $ro_le->id }}</th>
                    <td>{{ $ro_le->name }}</td>
                    <td>{{ $ro_le->label }}</td>
                    <td>{{ date('M j, Y', strtotime($ro_le->created_at)) }}</td>
                    <td> 
                    
                    {{ Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $ro_le->id]]) }}
                    <a href="{{ route('roles.edit', $ro_le->id) }}" class="btn btn-primary btn-sm">Edit</a>
	 				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
			        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            </table>
        </div>

        <div class="col-md-4">
        <br><br><br><br><br>
        <div class="panel panel-default">
                <div class="panel-heading">
                    Role
                </div>

                <div class="panel-body">
              
                @if(isset($role))
                
                   	{!! Form::model($role, ['route' => ['roles.update', $role->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}

                	{{ Form::label('name','Role Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('label','Role Label',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::text('label',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Update Role', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                    {!! Form::open(array('route' => 'roles.store', 'data-parsley-validate' => '')) !!}
                   	
				  <!-- text input field -->
				 
				  {{ Form::label('name','Role Name',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('name','',array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('label','Role Label',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::text('label','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
				  <!-- submit buttons -->
				 {{ Form::submit('Create Role', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}	
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