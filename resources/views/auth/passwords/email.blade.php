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
					@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
					@endif
									
					{!! Form::open(array('url' => 'password/email', 'data-parsley-validate' => '', 'files' => true)) !!}

					{{ Form::hidden('token') }}
			 
				        <p>Email :</p>
				 
				        <p>{{ Form::email('email','',array('id'=>'','class'=>'form-control', 'required' => '')) }}</p>

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