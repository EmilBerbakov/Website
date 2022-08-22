<!-- To enable author output, uncomment all code marked For Author Output
	To enable non author output, uncomment all code marked For NON Author Output
-->

<?php $title="Emil's Library Database Search Results";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1>Encyclopedia Berb's Library - Search Results</h1>
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?>
<br/>


<!--Here are the connection and query scripts.-->

<?php include 'php-addons/BookFunGenericQuery.php';?>
<!--Button to start a new search-->
<a class="btn btn-dark" href="BookFormMark2.php" role="button">New Search</a>
<br />


<!--And here's how we show the results!-->

<!--This is what shows if, after a round of DB searching and RESTful query, nothing is found-->
<?php 
	if (($dbresultscount==0) &(($curlresults==0)|($curlresults=='[]'))) {
		die( '<h4>No results for '.$column.' = '.$params[0].'.  Please try again with different parameters.</h4>');
	} ?>


<!--Else, we start building the results table.  Up first, is the header column. -->
<br/>
<form action="EditLibrary.php" method="post">
<table class='table table-boardered border-secondary' id="searchresults" style='width:75%'>
	<tr id="header">
		<th><label for 'title-output'>Book Title</label></th>
		<th><label for 'ISBN13-output'>ISBN-13</label></th>
		<th><label for 'ISBN10-output'>ISBN-10</label></th>
		<th><label for 'OLID-output'>Open Library ID</label></th>
		<!--<th> <label for 'AUTHOR-output'>Author Name</label></th>-->
		<?php 
			if (isset($_SESSION['USER_ID_NUMBER'])){
			echo "<th>Want or Own?</th> <th>Read?</th>";
			};
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
		if (isset($_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"])){
		unset ($_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"]);
		}
		break;

}

//Now, we loop through each line in $outputresults and print out a row to populate with the desired output



//For NON author output
foreach ($outputresults as $ln){
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
if (isset($_SESSION['USER_ID_NUMBER'])){
	include 'php-addons/BookFunGenericSearchResults-Members.php';
};
	echo "</tr>";
		}	

;?>
</table>
<input type="submit" value="Add to library" class="btn btn-dark"  id='libadd' >
</form>


	
</body>
</html>
