<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
        <br><br><br><br><br>
            <h2>Assign Permission To Role</h2>
            <p>You Can See Here Your All Role-Permission.</p>

        <table class="table table-bordered">
            <thead class="thead-inverse">
                <tr class="info">
                  <th>#</th>
                  <th>Role Name</th>
                  <th>Label Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($allrole as $ro_le)
                        
                <tr>
                    <th>{{ $ro_le->id }}</th>
                    <td>{{ $ro_le->name }}</td>
                    <td>{{ $ro_le->label }}</td>
                    <td> 

                    <a href="{{ url('fetchassigndata', $ro_le->id) }}" class="btn btn-primary btn-sm">Assign Permission</a>
                  
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
                    Assign Permission
                </div>

                <div class="panel-body">
              
                @if(isset($role))
                
                  {!! Form::model($role, ['url' => ['permissionupdate', $role->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
                  {{ Form::label('name','Role Name',array('id'=>'','class'=>'control-label')) }}
				          {{ Form::text('name',null,array('id'=>'','class'=>'form-control', 'required' => '')) }}

                  {{ Form::label('label','Permissions',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::select('permissions[]',$permissions, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}
				  
          				<!-- submit buttons -->
          				{{ Form::submit('Give Permission', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

                @else	

                  For Assign Permission To Role Click On <b><u>"Assign Permission"</u></b> Botton.
                  <!-- {!! Form::open(array('route' => 'roles.store', 'data-parsley-validate' => '')) !!}
            		  {{ Form::label('name','Role Name',array('id'=>'','class'=>'control-label')) }}
        				  {{ Form::text('name','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
                  {{ Form::label('label','Permissions',array('id'=>'','class'=>'control-label')) }}
                  {{ Form::text('label','',array('id'=>'','class'=>'form-control', 'required' => '')) }}
				  
        				 {{ Form::submit('Create Role', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}	
            		 {{ Form::close() }} -->
			          
                @endif 
                </div>
            </div>
        </div>



    </div>

@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}

  <script type="text/javascript">
    $('.select2-multi').select2();

    <?php if(isset($role)) { ?>
    $('.select2-multi').select2().val({!! json_encode($role->permissions()->getRelatedIds()) !!}).trigger('change');
    <?php } ?>
  </script>
@endsection