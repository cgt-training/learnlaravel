<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           	{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}

				  <!-- text input field -->
				 
				  {{ Form::label('posttitle','Post Title',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::text('title','',array('id'=>'','class'=>'form-control')) }}
				  
				  
				  <!-- textarea field -->
				  
				  {{ Form::label('description','Description',array('id'=>'','class'=>'control-label')) }}
				  {{ Form::textarea('body','',array('id'=>'','class'=>'form-control')) }}

				  
				  <!-- submit buttons -->
				 {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}	
				 
				  
				  <!-- password inputs -->
				  <!-- {{ Form::label('password','Password',array('id'=>'','class'=>'')) }}
				  {{ Form::password('password','',array('id'=>'','class'=>'')) }} -->
				  
				  <!-- email input -->
				  <!-- {{ Form::label('email','Email',array('id'=>'','class'=>'')) }}
				  {{ Form::email('email','hello@clivern.com',array('id'=>'','class'=>'')) }} -->
				  
				  <!-- select box -->
				  <!-- {{ Form::label('status','Status',array('id'=>'','class'=>'')) }}
				  {{ Form::select('status',array('enabled'=>'Enabled','disabled'=>'Disabled'),'enabled') }} -->
				  
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
        </div>
    </div>
</div>
@endsection