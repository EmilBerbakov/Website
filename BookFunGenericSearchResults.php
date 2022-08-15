<style>
th,td {
	boarder-spacing:5px;
	border: 1px solid black;
}
table {
	border-spacing:5px;
	border: 1px solid black;
}
</style>
<?php $title="Emil's Library Database Search Results";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
<body>
<h1>Encyclopedia Berb's Library - Search Results</h1>
<?php include('php-addons/toolbar.php');include("php-addons/standardjsimport.php");?>
<h4>Results:</h4>
<form action="BookFormMark2.php" method="post">
<input type="submit" value="Back" id='back'>
</form>
<?php include 'php-addons/BookFunGenericConnection.php';include 'php-addons/BookFunGenericQuery.php';?>
<?php 
	if ($resultscount==0) {
		die( '<h4>No results for '.$column.' = '.$params[0].'.  Please try again.</h4>');
		}
?>
<table id="searchresults" style='width:50%'>
	<tr id="header">
		<th><label for 'title-output'>Book Title</label></th>
		<th><label for 'ISBN13-output'>ISBN-13</label></th>
		<th><label for 'ISBN10-output'>ISBN-10</label></th>
	</tr>
	<tr>
<?php foreach ($results as $ln){
	echo "<td>".$ln['TITLE']."</td>";
	echo "<td>".$ln['ISBN_13']."</td>";
	echo "<td>".$ln['ISBN_10']."</td>";
	};?>
	</tr>
</table>
		
	
</body>
</html>
