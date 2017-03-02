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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Create New Post</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="fa fa-laptop"></i>Create New Post</li>						  	
					</ol>
				</div>
			</div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
                 	{!! Form::open(array('route' => 'postadmin.store', 'data-parsley-validate' => '', 'files' => true)) !!}

				  <!-- text input field -->
				 
				  {{ Form::label('posttitle','Post Title',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('title','',array('id'=>'','class'=>'form-control', 'required' => '', 'maxlength' => '25')) }}

				  <!-- text input field -->
				 
				{{ Form::label('postslug','Post Slug',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('slug','',array('id'=>'','class'=>'form-control', 'required' => '', 'maxlength' => '255')) }}

				  
				{{ Form::label('select_category','Select Category',array('id'=>'','class'=>'control-label')) }}  
				<select class="form-control my-select" name="category_id" required>
				<option value="">Select Category</option>
				    @foreach($allCategories as $allCategoriess)
				        <option value="{{$allCategoriess->id}}">{{$allCategoriess->cat_name}}</option>
				    @endforeach
			    </select>


			    {{ Form::label('select_tag','Select Tags',array('id'=>'','class'=>'control-label')) }} 
			    <select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
					@endforeach

				</select>

			    
				  <!-- textarea field -->
				  
				  {{ Form::label('description','Description',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::textarea('body','',array('id'=>'','class'=>'form-control', 'required' => '', 'maxlength' => '1000')) }}

				  {{ Form::label('image','Upload Image',array('class'=>'control-label')) }}
				  {{Form::file('featured_img',array('class'=>'form-control'))}}

				  
				  <!-- submit buttons -->
				 {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}	
				 
				  
				  <!-- password inputs -->
				  <!-- {{ Form::label('password','Password',array('id'=>'','class'=>'')) }}
				  {{ Form::password('password','',array('id'=>'','class'=>'')) }} -->
				  
				  <!-- email input -->
				  <!-- {{ Form::label('email','Email',array('id'=>'','class'=>'')) }}
				  {{ Form::email('email','hello@clivern.com',array('id'=>'','class'=>'')) }} -->
				  
				  <!-- radio buttons -->
				  <!-- {{ Form::label('status','Status',array('id'=>'','class'=>'')) }}
				  {{ Form::radio('status','enabled',true) }} Enabled
				  {{ Form::radio('status','disabled') }} Disabled -->
				  
				  <!-- checkbox -->
				  <!-- {{ Form::label('status','Status',array('id'=>'','class'=>'')) }}
				  {{ Form::checkbox('status','1',true) }} Enabled -->

				  <!-- hidden field -->
				  <!-- {{ Form::hidden('record_to_update','1') }} -->
				  
				  <!-- reset buttons -->
				  <!-- {{ Form::reset('Reset') }} -->
				  
				  <!-- normal buttons -->
				  <!-- {{ Form::button('Normal') }} -->


<!-- Create Post Form -->
				  
			{{ Form::close() }}
			<br><br><br>
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
	</script>
@endsection
	