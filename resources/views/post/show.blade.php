<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Show Post')
@section('active2', 'active')

@section('content')
<div class="container">
	@include('partials._massage')
	<div class="row">
        <div class="col-md-7">
           	<h1>{{ $data[0]->title }}</h1><br>
           	<h4 style="text-align: justify;">{{ $data[0]->body }}</h4>
        </div>
        <div class="col-md-5">
        <div class="well">
        	<dl class="dl-horizontal">
        		<dt>
        			url:
        		</dt>
        		<dd>
        			{{Request::url()}}
        		</dd>
        	</dl>
        	<dl class="dl-horizontal">
        		<dt>
        			Created Date :
        		</dt>
        		<dd>
        		<?php $timestamp = strtotime($data[0]->created_at);
        		 $new_date_format = date('M d Y H:i', $timestamp); ?>
        			{{$new_date_format }}
        		</dd>
        	</dl>
        	<dl class="dl-horizontal">
        		<dt>
        			Last Updated :
        		</dt>
        		<dd>
        			<?php $timestamp = strtotime($data[0]->updated_at);
        		 $new_date_format = date('M d Y H:i', $timestamp); ?>
        			{{$new_date_format }}
        		</dd>
        	</dl>
        

        <div class="col-md-6">
           	 {!! Html::linkRoute('posts.edit', 'Edit Post', array($data[0]->id), array('class' => 'btn btn-primary btn-block')) !!}

        </div>

        <div class="col-md-6">
        {{ Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $data[0]->id]]) }}
   			 {{ Form::submit('Delete Post', ['class' => 'btn btn-danger btn-block']) }}
		{{ Form::close() }}

           	 <!-- {!! Html::linkRoute('posts.destroy', 'Delete Post', array($data[0]->id), array('class' => 'btn btn-danger btn-block')) !!} -->

        </div>

        <br><br><br><center><a style="text-decoration: none; cursor: pointer;" href="{{ route('posts.index') }}" class="btn btn-default btn-sm">
        >>> Show All Posts >>>
        </a></center>

        </div>
        </div>

    </div>
</div>
<style type="text/css">
	dt{text-align: left !important;}
</style>
@endsection