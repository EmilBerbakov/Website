<?php
foreach($_POST as $key=>$value){
	if ($value != "") {
		$column=$key;
		$params=array($value);

	}
}
if (isset($_POST['ISBN_13'])|isset($_POST['ISBN_10'])|isset($_POST['OL_ID'])|isset($_POST['GR_ID'])|isset($_POST['LT_ID'])) {
	try {
		$query="SELECT * FROM EDITION_INFO where $column=?";
		$getresults=$conn->prepare($query);
		$getresults->execute($params);
		$results=$getresults->fetchAll(PDO::FETCH_ASSOC);
		$resultscount=count($results);
	}
	catch(Exception $e){
		die(print_r($e->getMessage()));
	}	
}

;?>




