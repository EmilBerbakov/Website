<!--In the case we don't get any results from the db search (and for Title searches for the time being) we will default to performing a curl query on Open Library's website. -->

<?php
	$curl=curl_init();
	switch($column) {
		case 'ISBN_13':
			$options=array(CURLOPT_URL=>"http://openlibrary.org/query.json?type=/type/edition&isbn_13=".$_POST['ISBN_13'],CURLOPT_RETURNTRANSFER=>True);
			break;
		case 'ISBN_10':	
			$options=array(CURLOPT_URL=>'http://openlibrary.org/query.json?type=/type/edition&isbn_10='.$_POST['ISBN_10'],CURLOPT_RETURNTRANSFER=>True);
			break;
		case 'TITLE':
			$fixedtitle=str_replace(' ','%20',$_POST['TITLE']);
			$options=array(CURLOPT_URL=>'http://openlibrary.org/query.json?type=/type/edition&title='.$fixedtitle,CURLOPT_RETURNTRANSFER=>True);
			break;
		case 'EDITION_ID':
			$options=array(CURLOPT_URL=>'http://openlibrary.org/books/'.$_POST['EDITION_ID'].'.json',CURLOPT_RETURNTRANSFER=>True);
			break;
	}
	curl_setopt_array($curl,$options);
	$curlreturn=curl_exec($curl);
	curl_close($curl);
	$curljson=json_decode($curlreturn,true);
	
if ($column!='EDITION_ID' & $curljson!=null){
	$curlresults=[];
	foreach ($curljson as  $book) {
		$curl=curl_init();
		$key='key';
		$options=array(CURLOPT_URL=>"http://openlibrary.org".$book[$key].".json",CURLOPT_RETURNTRANSFER=>True);
		curl_setopt_array($curl,$options);
		$curlbookquery=curl_exec($curl);
		curl_close($curl);
		$curlresultsjson=json_decode($curlbookquery);
		include 'BookFunGenericQueryRESTfulParse.php';
		}
}
elseif ($curljson!=null & $curljson!=[] & isset($curljson['error'])==false) {
	$curlresultsjson=json_decode($curlreturn);
	include 'BookFunGenericQueryRESTfulParse.php';
}
else {
	$curlresults=0;
}
;?>

