<!-- Stored in resources/views/layouts/master.blade.php -->
@include('partials._head')
@yield('style')
<body id="app-layout">
   @include('partials._nav')

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('jsfile')
</body>
</html>
