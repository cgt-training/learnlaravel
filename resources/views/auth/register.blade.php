<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Register')
@section('register', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                     {!! Form::open(array('route' => 'register', 'data-parsley-validate' => '', 'files' => true)) !!}
 
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
</div>
@endsection


@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection