<?php $title="Your Library";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1>
<?php echo $_SESSION['FIRST_NAME']."'s Library"; ?>
</h1>
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?> 
<br/>

<?php
try{
include "php-addons/BookFunGenericConnection.php";
$userlib='USER_'.$_SESSION['USER_ID_NUMBER'].'_LIBRARY';
//This has to be a left join because, at this point, not all books in a user's library will be in the database".
$dbquery="execute Libraries.USERLIBRARY @USERTABLE=".$userlib."";

$dbgetresults=$conn->prepare($dbquery);
$dbgetresults->execute();
$dbresults=$dbgetresults->fetchAll(PDO::FETCH_ASSOC);
$dbresultscount=count($dbresults);

if ($dbresultscount==0) {
	echo "<h4>You have no books in your library yet.  Why don't you go add some?</h4><br />";
	echo "<a class='btn btn-dark' href='BookFormMark2.php' role='button'>Let's go!</a>";
	die();
}

}

catch (Exception $e) {
print_r($e);
die(include 'php-addons/ErrorMessage.php');
}

;?>

<!--To-Do: make the Search Results table its own PHP since this going to be the same in basic appearance for each view.  The only difference will be that this table can take books away.
-->
<table class='table table-boardered border-secondary' id="mylibraryresults" style='width:75%'>
	<tr id="header">
		<th><label for 'title-output'>Book Title</label></th>
		<th><label for 'ISBN13-output'>ISBN-13</label></th>
		<th><label for 'ISBN10-output'>ISBN-10</label></th>
		<th><label for 'OLID-output'>Open Library ID</label></th>
		<th><label for 'BOOK_NUM-output'>Number of Copies</label></th>
		<th><label for 'OWNERSHIP-output'>Own or Want</label></th>
		<th><label for 'READING-output'>Reading Status</label></th>
		
<?php
foreach($dbresults as $ln) {
	$edid=$ln['EDITION_ID'];
	if ($ln['SUBTITLE']!==null) {
		$fullTitle=$ln['TITLE'].': '.$ln['SUBTITLE'];
	}
	else {
		$fullTitle=$ln['TITLE'];
	}
	echo "<tr id='$edid'>";
	echo "<td>".$fullTitle."</td>";
	echo "<td>".$ln['ISBN_13']."</td>";
	echo "<td>".$ln['ISBN_10']."</td>";
	echo "<td>".$edid."</td>";
	echo "<td>".$ln['BOOK_NUM']."</td>";
	echo "<td>".$ln['OWNERSHIP_STRING']."</td>";
	echo "<td>".$ln['STATUS_NAME']."</td>";
	echo "</tr>";
}

;?>
