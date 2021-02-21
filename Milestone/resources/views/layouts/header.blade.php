<!-- header(navbar) -->
<!-- stylesheet -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/style.css') }}">

<!-- Suspended/not logged in -->
@if(null == session('role') || session('role') == -1)
<link rel="stylesheet" type="text/css" href="{{ url('public/css/style.css') }}">
<ul>
  <li><a href="home" class="button">Home</a></li>
  <li><a href="register" class="button">Register</a></li>
  <li><a href="login" class="button">Login</a></li>
</ul>
<br>
<h2 style="
align-content: center; 
text-align: center;
font-family: Brush Script MT, cursive;">Welcome to Linked Out</h2>

<!-- Admin -->
@elseif(session('role') == 1 || session('role') == 2)
<link rel="stylesheet" type="text/css" href="{{ url('public/css/style.css') }}">
<ul>
  <li><a href="home" class="button">Home</a></li>
    <!-- <li><a href="register" style="text-align:center;align:center;">Register</a></li> -->
    <!-- <li><a href="login" style="text-align:center;align:center;">Login</a></li> -->
  <li><a href="logged" class="button">View/Edit Users</a></li>
  <li><a href="logout" class="button">Log Out</a></li>
</ul>
<br>
<h2 style="
align-content: center; 
text-align: center;
font-family: Brush Script MT, cursive;">Welcome to Linked Out</h2>

<!-- Base user -->
@elseif(session('role') == 3)
<ul>
  	<li><a href="home" class="button">Home</a></li>
  	 <li><a href="logged" class="button">Profile</a></li>
  	 <li><a href="logout" class="button">Log Out</a></li>
</ul>

<!-- catch all = not logged in case -->
@else

<ul>
  	<li><a href="home" class="button">Home</a></li>
	<li><a href="register" class="button">Register</a></li>
	<li><a href="login" class="button">Login</a></li>
</ul>
<br>
@endif