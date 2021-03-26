<!-- appmaster page which combines header and footer into one layout -->
<html lang="en">
<head>
<!--     <link href="../css/Style.css" media="screen" rel="stylesheet" type="text/css" /> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('resources/js/custom.js') }}"></script>
    <title>@yield('title')</title>
	@include('layouts.header')  
</head>
<body style="background-image:'pictures/LinkedOutBG.png';">
    <div align="center">
        @yield('content')
    </div>
</body>
@include('layouts.footer')
</html>
