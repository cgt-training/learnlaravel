<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
        <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i> Permissions</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            <li><i class="fa fa-laptop"></i>Permission</li>                
          </ol>
        </div>
      </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
      @include('partials._massage')
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
                    
                    {{ Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $per_mission->id],  'class' =>'delete']) }}
                    <a href="{{ route('permissions.edit', $per_mission->id) }}" class="btn btn-primary btn-sm">Edit</a>
	 				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
			        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            
            <tr><td colspan="5" style="text-align: center;">
              {{ $allpermission->links() }}
            </td></tr>

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
</section>
</section>
@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
    <script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this?");
    });
</script>
@endsection