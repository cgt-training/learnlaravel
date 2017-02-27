<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.pages')

@section('title', 'Show Blog Post')

@section('style')
  {!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
           	<h1>{{ $post->title }}</h1>
            <?php $timestamp = strtotime($post->created_at);
             $new_date_format = date('M d Y H:i', $timestamp); ?>
              
            Posted at: <code>{{$new_date_format }}</code>
            <h4 class="pull-right">Category : {{ $post->category->cat_name }}
            </h4>
            <br><br>
           	<h4 style="text-align: justify;">{{ $post->body }}</h4>
            @foreach($post->tags as $tag)
              <span class="badge">{{ $tag->name }}</span>
            @endforeach
            <br><br>
            {{ HTML::image('images/'.$post->image, '', array('class' => 'is')) }}
        </div>
    </div>

<?php //echo '<pre>'; print_r($comment);  ?>
   <br><br>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(!isset($comment[0]->id))
              <h3>No Comment Yet, Be The First</h3>
            @else
              <h2>Comments :-</h2>
              @foreach($comment as $comments)
                <div class="row">
                  <div class="col-md-10 col-md-offset-2">
                    <h4 style="color: black;">{{ $comments->name }}</h4>
                    <pre class="m">Email:- <i>{{ $comments->email }}</i>></pre>
                    <pre class="m">Date:- <i>{{ $comments->created_at }}</i></pre>
                  </div>
                  <div class="col-md-8 col-md-offset-2">
                   <br> <p style="text-align: justify;">{{ $comments->comment }}</p>
                  </div>
                  <div class="col-md-2">

                 {{ Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comments->id]]) }}
                 {!! Form::hidden('slug', $post->slug) !!}
                  @can('edit_topic')                 
                    <a href="{{ route('blog.edit', [$comments->id, $post->slug]) }}" title="Edit" class="btn btn-primary btn-block btn-sm">Edit</a>
                  @endcan
                  @can('delete_topic')
                  {{ Form::submit('Delete Category', ['class' => 'btn btn-danger btn-block btn-sm', 'title' => 'Delete']) }}
                  @endcan
                  {{ Form::close() }}  
              
                  </div>
                </div>
                <hr>
              @endforeach
            @endif    
        </div>
    </div>


    <div class="row">
    <br><br><br>
       @can('comment_topic')
        <div class="col-md-8 col-md-offset-2">
        <h3>Leave a Comment :- </h3><br>
        @if(!isset($getcomment[0]->id))

          {!! Form::open(array('route' => 'comments.store', 'data-parsley-validate' => '', 'files' => true)) !!}

          <!-- text input field -->

          {!! Form::hidden('post_id', $post->id) !!}
          {!! Form::hidden('slug', $post->slug) !!}

          <div class="row">
          <div class="col-md-6">
         
          {{ Form::label('name','Name',array('id'=>'','class'=>'control-label')) }}
          {{ Form::text('name','',array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '30')) }}
          </div>
          <!-- text input field -->
         <div class="col-md-6">
        {{ Form::label('email','Email',array('id'=>'','class'=>'control-label')) }}
          {{ Form::email('email','',array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '255')) }}
          </div>
          </div>
          <!-- textarea field -->
          
          {{ Form::label('comment','Add Comment',array('id'=>'','class'=>'control-label')) }}
          {{ Form::textarea('comment','',array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '1000')) }}
          
          <!-- submit buttons -->
          <div class="row">
          <div class="col-md-6">
         {{ Form::submit('Submit', array('class' => 'btn btn-success btn-block btn-lg', 'style' => 'margin-top: 20px;')) }}  
         </div>
         <div class="col-md-6">
         <a class="btn btn-primary btn-lg" href="{{url('home')}}" role="button" style="margin-top: 20px; width: 100%;">Cancel</a>
         </div>
         </div>
          
      {{ Form::close() }}
      
      @else 

        {!! Form::model($getcomment, ['route' => ['comments.update', $getcomment[0]->id], 'data-parsley-validate' => '', 'method' => 'PUT']) !!}
          <!-- text input field -->

          {!! Form::hidden('post_id', $post->id) !!}
          {!! Form::hidden('slug', $post->slug) !!}

          <div class="row">
          <div class="col-md-6">
         
          {{ Form::label('name','Name',array('id'=>'','class'=>'control-label')) }}
          {{ Form::text('name',$getcomment[0]->name,array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '30')) }}
          </div>
          <!-- text input field -->
         <div class="col-md-6">
        {{ Form::label('email','Email',array('id'=>'','class'=>'control-label')) }}
          {{ Form::email('email',$getcomment[0]->email,array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '255')) }}
          </div>
          </div>
          <!-- textarea field -->
          
          {{ Form::label('comment','Add Comment',array('id'=>'','class'=>'control-label')) }}
          {{ Form::textarea('comment',$getcomment[0]->comment,array('id'=>'','class'=>'form-control w', 'required' => '', 'maxlength' => '1000')) }}
          
          <!-- submit buttons -->
          <div class="row">
          <div class="col-md-6">
         {{ Form::submit('Submit', array('class' => 'btn btn-success btn-block btn-lg', 'style' => 'margin-top: 20px;')) }}  
         </div>
         <div class="col-md-6">
         <a class="btn btn-primary btn-lg" href="{{url('home')}}" role="button" style="margin-top: 20px; width: 100%;">Cancel</a>
         </div>
         </div>
          
      {{ Form::close() }}
      @endif
        </div>
       @endcan
    </div>
</div>
<br><br><br><br>
<style type="text/css">
  .m{ width: 80%; margin-left: 2%; padding: 0px 0px 0px 15px; border: none; color: brown; }
  .is{width: 50%; }
</style>
@endsection

@section('jsfile')
  {!! Html::script('js/parsley.min.js') !!}
@endsection