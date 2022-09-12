<!-- To enable author output, uncomment all code marked For Author Output
	To enable non author output, uncomment all code marked For NON Author Output
-->
<!--Here are the connection and query scripts.-->
<?php include 'php-addons/BookFunGenericQuery.php';?>

<?php $title="Emil's Library Database Search Results";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1>Encyclopedia Berb's Library - Search Results</h1>
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?>
<br/>





<!--Button to start a new search-->
<a class="btn btn-dark" href="BookFormMark2.php" role="button">New Search</a>
<br />


<!--And here's how we show the results!-->

<!--This is what shows if, after a round of DB searching and RESTful query, nothing is found-->
<?php 
	if (($dbresultscount==0) &(($curlresults==0)|($curlresults=='[]'))) {
		die( '<h4>No results for '.$column.' = '.$params[0].'.  Please try again with different parameters.</h4>');
	}
	;?>

<!--Else, we start building the results table.  Up first, is the header column. -->
<br/>
<div class='container-fluid'>
<form action="EditLibrary.php" method="post">
<div class="table-responsive-sm">
<table class='table table-boardered border-secondary' id="searchresults">
	<tr id="header">
		<th>Book Title</th>
		<th>ISBN-13</th>
		<th>ISBN-10</th>
		<th>Open Library ID</th>
		<th>Author Name</th>
		<?php 
			if (isset($_SESSION['USER_ID_NUMBER'])) { ;?>
			<th>Want or Own?</th> <th>Read?</th>
		<?php	};
		;?>
	</tr>

<!--Next, we determine where our results come from: DB or RESTful.  From that, we feed the results into the $outputresults variable-->

<?php 
switch($dbresultscount) {
	case 0:	
		$outputresults=$curlresults;
		if (isset($_SESSION['USER_ID_NUMBER'])){
			//This is for a to-be-added feature.  If you got results from cURL request, check if it's in the db.  If not, add it.  This will require giving insert permission to the generic user, which may not be desired.  I could also have the stuff added go to a table in the Libraries schema.  From there, I can validate and add them in myself.  
		$_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"]=$outputresults;
		}
		break;
	case $dbresultscount>0:
		$outputresults=$dbresults;
		$uid=$_SESSION['USER_ID_NUMBER']??'Guest';
		if (isset($_SESSION[$uid."_CURLRESULTS"])){
		unset ($_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"]);
		}
		break;

}
foreach($outputresults as $edid=>$stuff){
	if ($stuff[0]['SUBTITLE']!==null) {
		$fullTitle=$stuff[0]['TITLE'].': '.$stuff[0]['SUBTITLE'];
	}
	else {
		$fullTitle=$stuff[0]['TITLE'];
	}	
	;?>
	<tr id= <?php echo '"'.$edid.'"';?>>
	<td><?php echo $fullTitle;?></td>
	<td><?php echo $stuff[0]['ISBN_13'];?></td>
	<td><?php echo $stuff[0]['ISBN_10'];?></td>
	<td><?php echo $edid;?></td>
	<td>
	<?php
	for($i=0;$i<count($stuff);$i++){
		echo $stuff[$i]['AUTHOR_NAME'];
		;?>
		<br/>
		
	<?php	
	} ;?>
	</td>
	<?php 
if (isset($_SESSION['USER_ID_NUMBER'])){
	include 'php-addons/BookFunGenericSearchResults-Members.php';
};
;?>
 </tr>
 <?php
		}	

;?>
</table>
<?php 
if (isset($_SESSION['USER_ID_NUMBER'])){ ;?>
</div>
<input type="submit" value="Add to library" class="btn btn-dark"  id='libadd' >
<?php }; 
;?>
</div>
</form>

</body>
</html>
