<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'login')
@section('login', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                     {!! Form::open(array('route' => 'login', 'data-parsley-validate' => '', 'files' => true)) !!}
			 
				        <p>Email :</p>
				 
				        <p>{{ Form::email('email','',array('id'=>'','class'=>'form-control', 'required' => '')) }}</p>
				 
				        <p>Password :</p>
				 
				        <p>{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control', 'required' => '' ) ) }}</p>

				        <p>{{ Form::checkbox('remember', '', array('class'=>'form-control') ) }}Remember Me</p> 
				 
				        <p>{{ Form::submit('Submit', array('class' => 'btn btn-success')) }}<br><a class="btn btn-link" href="{{ url('password/reset') }}">Forgot Your Password?</a> </p>
				 
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