<?php $title="Home";$smallpicture="icons/house.svg";include("php-addons/top.php");?>
</head>
<body>
<h1>Home Base</h1>
<?php include("php-addons/toolbar.php");include("php-addons/standardjsimport.php");?>
<?php if (isset($_SESSION['LOGIN_ERROR'])){
	echo('The email and password combination you entered was incorrect.  Please try again.');
}
elseif(isset($_SESSION['FIRST_NAME'])){
echo 'Welcome back, '.$_SESSION['FIRST_NAME'].'!  Stay awhile!';
}
else{
echo 'Welcome to my page!  I hope you enjoy it!';
};?>
</body>
</html>
