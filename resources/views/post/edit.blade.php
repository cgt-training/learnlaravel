<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Create Post')
@section('active2', 'active')

@section('style')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
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


			{{ Form::label('select_category','Select Category',array('id'=>'','class'=>'control-label')) }}
			{{ Form::select('category_id',[null=>'Select Category'] +  $allcat, null, array('class' => 'form-control my-select', "required" => '', 'name' => 'category_id')) }}

			{{ Form::label('select_tag','Select Tags',array('id'=>'','class'=>'control-label')) }} 
			{{ Form::select('tags[]',$tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}

			
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control', "required" => '']) }}

			{{ Form::submit('Update Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

        </div>
    </div>
</div>
@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');

	</script>
@endsection