<!-- header(navbar) -->
<!-- stylesheet - Get rid of 'public/' when uploading to azure -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/style.css') }}">

<!-- Suspended/not logged in -->
@if(null == session('role') || session('role') == -1)
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
<ul>
  	<li><a href="home" class="button">Home</a></li>
  	<li><a href="profile" class="button">Profile</a></li>
  	<li><a href="viewUsers" class="button">View/Edit Users</a></li>
  	<li><a href="jobs" class="button">View Job Listings</a>
  	<li><a href="groups" class="button">Groups</a>
  	<li><a href="logout" class="logOutButton">Log Out</a></li>

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
  	 <li><a href="profile" class="button">Profile</a></li>
  	 <li><a href="jobs" class="button">View Job Listings</a>
  	 <li><a href="groups" class="button">Groups</a>
  	 <li><a href="logout" class="logOutButton">Log Out</a></li>

</ul>

<!-- catch all = not logged in case -->
@else

<ul>
  	<li><a href="home" class="button">Home</a></li>
	<li><a href="register" class="button">Register</a></li>
	<li><a href="login" class="button">Login</a></li>
</ul>
<br/>
<h2 style="
align-content: center; 
text-align: center;
font-family: Brush Script MT, cursive;">Welcome to Linked Out</h2>

@endif
<br>