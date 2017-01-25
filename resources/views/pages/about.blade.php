@extends('layouts.pages')

@section('title', 'About')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="bs-example" data-example-id="simple-table"> 
        		<table class="table"> <caption>Optional table caption.</caption> 
        			
        			<thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> 

        			<tr><th scope="row">1</th> 
        			<td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> 

        			<tr> <th scope="row">2</th> 
        			<td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> 

        			<th scope="row">3</th> 
        			<td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> 
        			</tbody>
        	    </table> 
        	 </div>
        </div>
    </div>
</div>        
@endsection