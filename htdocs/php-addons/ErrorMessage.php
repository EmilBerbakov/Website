	<?php$title="Error";$smallpicture="icons/book.svg";include("php-addons/top.php");?>
   </head>
   <body>
	<h1>Error</h1>
	<?php include("php-addons/toolbar.php");?> <br />
	<?php include 'php-addons/standardjsimport.php';
	echo 'There was an unexpected error.  Please try what you were doing again.  If the issue persists, please email me using the "Send Me an Email" option in the Contact me section.';
	echo '<br /> <a class="btn btn-dark" href="index.php" role="button">Take Me Home</a>';?>
	</body>
	</html>
	<?php die();
	;?>