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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Create New User</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="fa fa-laptop"></i>Create New User</li>						  	
					</ol>
				</div>
			</div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
       
            <div class="panel panel-default">
                <div class="panel-heading">Create New User</div>
                <div class="panel-body">
                     {!! Form::open(array('route' => 'registerstore', 'data-parsley-validate' => '', 'files' => true)) !!}
 
				        <p>Name :</p>
				 
				        <p>{{ Form::text('name','',array('id'=>'','class'=>'form-control', 'required' => '', 'maxlength' => '255')) }}</p>
				 
				        <p>Email :</p>
				 
				        <p>{{ Form::email('email','',array('id'=>'','class'=>'form-control', 'required' => '')) }}</p>
				 
				        <p>Password :</p>
				 
				        <p>{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'required' => '' ) ) }}</p>
				 
				        <p>Confirm Password :</p>
				 
				        <p>{{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'class'=>'form-control', 'required' => '' ) ) }}</p>
				 
				        <p>{{ Form::submit('Submit', array('class' => 'btn btn-success btn-block')) }}</p>
				 
				    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</section>
</section>
@endsection


@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection