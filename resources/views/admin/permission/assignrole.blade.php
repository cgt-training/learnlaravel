<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
        <br><br><br><br><br>
            <h2>Assign Roles To User</h2>
            <p>You Can See Here Your All Role-User.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($alluser as $user)
                        
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> 

                    <a href="{{ url('fetchassignrole', $user->id) }}" class="btn btn-primary btn-sm">Assign Role</a>
                  
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
                    Assign Role
                </div>

                <div class="panel-body">
              
                @if(isset($userdetail))
                
                  {!! Form::model($userdetail, ['url' => ['roleupdate', $userdetail->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
                  {{ Form::label('name','User Name',array('id'=>'','class'=>'control-label')) }}
				          {{ Form::text('name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('role','Select Role',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::select('role_id',[null=>'Select Roll'] +  $allrole, null, array('class' => 'form-control my-select', "required" => '', 'name' => 'role_id')) }}
                  
          				<!-- submit buttons -->
          				{{ Form::submit('Assign Role', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                  For Assign Role To User Click On <b><u>"Assign Role"</u></b> Botton.
                @endif 
                </div>
            </div>
        </div>



    </div>

@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection