<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Create Post')
@section('active2', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           	{!! Form::model($post, ['route' => ['posts.update', $post->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg', "required" => '']) }}

			{{ Form::label('slug', 'Slug:') }}
			{{ Form::text('slug', null, ["class" => 'form-control input-lg', "required" => '']) }}
			
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control', "required" => '']) }}

			{{ Form::submit('Update Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

        </div>
    </div>
</div>
@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
@endsection