

<?php
try{
include "php-addons/BookFunGenericConnection.php";
//$title="Your Library";$smallpicture="icons/bookicon.png";include("php-addons/top.php");
session_start();
$userlib='USER_'.$_SESSION['USER_ID_NUMBER'].'_LIBRARY';
//first check if the library exists
//This has to be a left join because, at this point, not all books in a user's library will be in the database".
//This is safe to leave as is because $userlib is not set by user.  Still, this is something I want to change.
/*
$dbquery="SELECT b.EDITION_ID, a.TITLE, a.SUBTITLE, a.ISBN_10, a.ISBN_13,c.OWNERSHIP_STRING,d.STATUS_NAME,b.BOOK_NUM
FROM Libraries.".$userlib." b
left join EDITION_INFO_2 a on a.EDITION_ID=b.EDITION_ID
join ZC_OWNERSHIP_STATUS c on c.OWNERSHIP_ID=b.OWNERSHIP_STATUS
join ZC_READING_STATUS d on d.STATUS_ID=b.READ_STATUS
";
*/
$dbquery="execute Libraries.USERLIBRARY @USERTABLE=".$userlib."";

$dbgetresults=$conn->prepare($dbquery);
$dbgetresults->execute();
$dbresults=$dbgetresults->fetchAll(PDO::FETCH_ASSOC);
$dbresultscount=count($dbresults);
//print_r($_SESSION);
//die();
$title="Your Library";$smallpicture="icons/bookicon.png";include('php-addons/top.php');
//print_r($_SESSION);
//die();
;?>
</head>
<body>
<h1>
<?php echo $_SESSION['FIRST_NAME']."'s Library"; ?>
</h1>
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?> 
<br/>
<?php
if ($dbresultscount==0) {
;?>	
	<h4>You have no books in your library yet.  Why don't you go add some?</h4><br />
	<a class='btn btn-dark' href='BookFormMark2.php' role='button'>Let's go!</a>
<?php
	die();
}

}

catch (Exception $e) {
//print_r($e);
die(header('Location: ErrorMessage.php'));

}

;?>

<!--To-Do: make the Search Results table its own PHP since this going to be the same in basic appearance for each view.  The only difference will be that this table can take books away.
-->
<div class='container-fluid'>
<form action="EditLibrary.php" method="post">
<div class="table-responsive-sm">
<table class='table table-boardered border-secondary' id="mylibraryresults" >
	<tr id="header">
		<th>Book Title</th>
		<th>ISBN-13</th>
		<th>ISBN-10</th>
		<th>Open Library ID</th>
		<th>Number of Copies</th>
		<th>Own or Want</th>
		<th>Reading Status</th>
		
<?php
foreach($dbresults as $ln) {
	$edid=$ln['EDITION_ID'];
	if ($ln['SUBTITLE']!==null) {
		$fullTitle=$ln['TITLE'].': '.$ln['SUBTITLE'];
	}
	else {
		$fullTitle=$ln['TITLE'];
	} ;?>
	<tr id='<?php echo $edid;?>'>
	<td><?php echo $fullTitle;?></td>
	<td><?php echo $ln['ISBN_13'];?></td>
	<td><?php echo $ln['ISBN_10'];?></td>
	<td><?php echo $edid;?></td>
	<td><input type="number" required min="0" id="<?php echo $edid;?>-COUNT" name="<?php echo $edid;?>[COUNT]" class="form-control input-number" value=<?php echo $ln['BOOK_NUM'];?>>
	</td>
	<td><?php echo $ln['OWNERSHIP_STRING'];?></td>
	<td><?php echo $ln['STATUS_NAME'];?></td>
	</tr>
<?php }

;?>

</table>
</div>
<input type="submit" value="Edit library" class="btn btn-dark"  id='libedit' >
</form>
</div>
</body>
</html>