@if (Session::has('success'))
    
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>

@endif