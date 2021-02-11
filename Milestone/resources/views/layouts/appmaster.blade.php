<html lang="en">
<head>
    <title>@yield('title')</title>
</head>
<body>
	@include('layouts.header')
    <div align="center">
        @yield('content')
    </div>
    @include('layouts.footer')
</body>
</html>
