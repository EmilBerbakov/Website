<html lang="en">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home - Test Environment <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutme.php">About Me</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="projectDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Projects
        </a>
		<ul class="dropdown-menu" aria-labelledby="projectDropdown">
          <li><a class="dropdown-item" href="BookFormMark2.php">Library Database</a></li>
		  <li><a class="dropdown-item" href="#" disabled><i>More Coming Soon</i></a></li>
		</ul>  
      </li>
	 <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="contactDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Contact Me
		</a>
		<ul class="dropdown-menu" aria-labelledby="contactDropdown">
			<li><a class="dropdown-item" href="https://www.linkedin.com/in/emil-berbakov/" target="_blank" rel="noopener noreferrer">Message me on LinkedIn</a></li>
			<li><a class="dropdown-item" href="mailto:emberbakov@gmail.com">Send Me an Email </a></li>
			<li> <a class="dropdown-item" href="resume.php">Read my Resume</a></li>
			
		</ul>
	</li>
	<?php
		if (isset($_SESSION['USER_ID_NUMBER'])){;?>
			<li class="nav-item"><a class="nav-link" href="LogoutForm.php">Logout</a></li>
			<li class="nav-item"><a class="nav-link" href="MyProfile.php">My Profile</a></li>
	<?php 
	}
	else{ 
	;?>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="loginDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
		<ul>
		<form class="dropdown-menu p-4" action="LoginForm.php" method="post">
			<div class="mb-3">
				<label for="emailentry" class="form-label">Email</label>
				<input type="email" class="form-control" id="emailentry" placeholder="email@example.com" required name="emailentry">
			</div>
			<div class="mb-3">
				<label for="passwordentry" class="form-label">Password</label>
				<input type="password" class="form-control" id="passwordentry" placeholder="Password" required name="passwordentry">
			</div>
		<button type="submit" class="btn btn-secondary">Sign in</button>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="/AccountCreation.php">Create an account</a>
		</form>
		</ul>
		
		<!--add back in when account recovery is implemented
		<a class="dropdown-item" href="/AccountRecovery.php">Forgot password</a>
		-->
			
	</li>
	<?php ;};?>
    </ul>
  </div>
</nav>