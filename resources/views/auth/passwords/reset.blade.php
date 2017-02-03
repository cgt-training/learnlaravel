<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'reset')
@section('reset', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>

				<div class="panel-body">

					{!! Form::open(array('url' => 'password/reset', 'data-parsley-validate' => '', 'files' => true)) !!}

					{{ Form::hidden('token',$token) }}
			 
				        <p>Email :</p>
				 
				        <p>{{ Form::email('email',$email,array('id'=>'','class'=>'form-control', 'required' => '')) }}</p>

				        <p>{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'required' => '' ) ) }}</p>
				 
				        <p>Confirm Password :</p>
				 
				        <p>{{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'class'=>'form-control', 'required' => '' )) }}</p>

				        <p>{{ Form::submit('Reset Password', array('class' => 'btn btn-primary')) }}<br></p>
				 
				    {{ Form::close() }}

				</div>
			</div>
		</div>
    </div>
</div>
@endsection
@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection