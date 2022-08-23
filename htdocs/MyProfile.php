<?php $title="Emil's Library Database Search Results";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1><?php echo $_SESSION['FIRST_NAME']."'s Personal Page";?> </h1> 
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?> </h1>
<br/>



<form action="MyLibrary.php" method="post">
<input type="submit" value="View My Library" id='librarybutton' class="btn btn-dark">
</form>
</body>
</html>
