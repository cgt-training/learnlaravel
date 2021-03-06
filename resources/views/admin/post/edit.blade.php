<!-- Stored in resources/views/child.blade.php -->
@extends('admin.layout')

@section('style')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
<section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Post</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="fa fa-laptop"></i>Edit Post</li>						  	
					</ol>
				</div>
			</div>
    <div class="row">
 
        <div class="col-md-8 col-md-offset-1">
           	{!! Form::model($post, ['route' => ['postadmin.update', $post->id], 'data-parsley-validate' => '', 'method' => 'PUT', 'files' => 'true']) !!}
		
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg', "required" => '']) }}

			{{ Form::label('slug', 'Slug:') }}
			{{ Form::text('slug', null, ["class" => 'form-control input-lg', "required" => '']) }}


			{{ Form::label('select_category','Select Category',array('id'=>'','class'=>'control-label')) }}
			{{ Form::select('category_id',[null=>'Select Category'] +  $allcat, null, array('class' => 'form-control my-select', "required" => '', 'name' => 'category_id')) }}

			{{ Form::label('select_tag','Select Tags',array('id'=>'','class'=>'control-label')) }} 
			{{ Form::select('tags[]',$tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}

			{{ Form::label('image','Upload Image',array('class'=>'control-label')) }}
			{{Form::file('featured_img',array('class'=>'form-control'))}}
			{{ HTML::image('images/'.$post->image, '', array('class' => 'is')) }}
			<br>
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control', "required" => '']) }}

			{{ Form::submit('Update Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

        </div>
    </div>

</section>
</section>
@endsection

@section('jsfile')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');

	</script>
	<style type="text/css">
	.is{width: 30%; }
	</style>
@endsection