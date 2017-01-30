<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Show Post')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-7">
           	<h1>{{ $post->title }}</h1><br>
           	<h4 style="text-align: justify;">{{ $post->body }}</h4>
        </div>
    </div>
</div>
<style type="text/css">
	dt{text-align: left !important;}
</style>
@endsection