<style>
form{
	margin:auto;
	width:50%;
	
}
</style>
<?php $title="Login";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1>Create an Account</h1>
<?php include("php-addons/toolbar.php");include("php-addons/standardjsimport.php");?>
<div class="form-center">
<form action="AccountCreationCheck.php" method="post">
			<div class="mb-3">
				<label for="firstnamecreate" class="form-label">First Name</label>
				<input type="text" class="form-control" id="firstnamecreate" required name="firstnamecreate">
			</div>
			<div class="mb-3">
				<label for="lastnamecreate" class="form-label">Last Name</label>
				<input type="text" class="form-control" id="lastnamecreate" required name="lastnamecreate">
			</div>
			<div class="mb-3">
				<label for="emailcreate" class="form-label">Email</label>
				<input type="email" class="form-control" id="emailcreate" placeholder="email@example.com" required name="emailcreate">
			</div>
			<div class="mb-3">
				<label for="passwordcreate1" class="form-label">Password</label>
				<input type="password" class="form-control" id="passwordcreate1" placeholder="Password" required name="passwordcreate1">
			</div>
		<!-- Implement this when you have the time.  This will set two vars, ps1 and ps2 by document.getElementById('passwordcreate1(2)')
		then do the warning thing like the book query
			<div class="mb-3">
				<label for="passwordcreate2" class="form-label" required>Confirm Password</label>
				<input type="password" class="form-control" id="passwordcreate2" placeholder="Password" name="passwordcreate2" onclick="psverify.js() required">
			</div>
			-->
		<button type="submit" class="btn btn-secondary">Create Account</button>
</form>
</div>
</body>
<?php include("php-addons/standardjsimport.php");?>
</head>
