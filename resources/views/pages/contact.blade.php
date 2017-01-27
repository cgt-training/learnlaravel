@extends('layouts.pages')

@section('title', 'Contact')
@section('active4', 'active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<form>
			<div class="col-md-7">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>
			</div>  
			<div class="col-md-7">
			  <div class="form-group">
			    <label for="exampleInputSubject">Subject</label>
			    <input type="text" class="form-control" id="exampleInputSubject" placeholder="Subject">
			  </div>
			</div>
			<div class="col-md-7">  
			  <div class="form-group">
			    <label for="exampleInputMessage">Message</label>
			    <textarea class="form-control" rows="3" id="exampleInputMessage" placeholder="Massage"></textarea> 
			  </div>
			  <button type="submit" class="btn btn-success btn-lg">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection