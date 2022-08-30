<?php
//This sets $column to the type of search the user is performing.  

foreach($_POST as $key=>$value){
		$column=$key;
		$params=array($value);

	};
	


//I am not letting DB searches on Title at this time.  This is due to the following:
//1.) I'm currently storing the titles as NVARCHAR(max).  Attempting to search on a non-index column like this takes awhile, especially because I want to allow fuzzy matching.  To solve this, the eventual plan is to convert the nvarchar to something smaller, create a hash index, and do title searches off that.
//2.) My personal machine has difficulty with handling external connections and external quieries that would take a while to resolve. The solution here would be to host my db on some cloud service, like Azure.
//So, due to all of that, title searches will default to the RESTful lookup.  All other available search options are indexed, so I will allow db search first, then RESTful search if it's not on the db.

//if ($column!=='TITLE') {	
	include 'php-addons/BookFunGenericConnection.php';
	try {
		/*
		In the event WORK_TO_AUTHOR and EDITION_TO_WORK does not get done in time:
		
		select a.TITLE,a.ISBN_13,a.ISBN_10,c.AUTHOR_NAME
		from EDITION_INFO_2 a

		left join EDITION_TO_AUTHOR b on a.EDITION_ID=b.EDITION_ID
		left join AUTHOR_INFO c on b.AUTHOR_ID=c.AUTHOR_ID

		where $column=?
		
		If it is done, this is what it will be:
		
		select a.TITLE,a.ISBN_13,a.ISBN_10,d.AUTHOR_NAME
		from EDITION_INFO_2 a
		
		join EDITION_TO_WORK b on a.EDITION_ID=b.EDITION_ID
		left join WORK_TO_AUTHOR c on b.AUTHOR_ID=c.AUTHOR_ID
		join AUTHOR_INFO d on c.AUTHOR_ID=d.AUTHOR_ID
		
		where $column=?
		*/
		if (in_array($column,array('TITLE','EDITION_ID','ISBN_10','ISBN_13'))==false){
			$column='EDITION_ID';
		}

		if($key=='TITLE'){
			$params[0]='"'.$params[0].'"';
		};

		//For Author Output
		if($column !=='TITLE'){
		$dbquery="select top 50 a.EDITION_ID,a.TITLE,a.SUBTITLE,a.ISBN_13,a.ISBN_10,c.AUTHOR_NAME from EDITION_INFO_2 a left join EDITION_TO_AUTHOR b on a.EDITION_ID=b.EDITION_ID left join AUTHOR_INFO c on b.AUTHOR_ID=c.AUTHOR_ID where a.$column=?";
		}

		else {
			$dbquery="select a.EDITION_ID,a.TITLE,a.SUBTITLE,a.ISBN_13,a.ISBN_10,c.AUTHOR_NAME
			from EDITION_INFO_2 a
	
			left join EDITION_TO_AUTHOR b on a.EDITION_ID=b.EDITION_ID
			left join AUTHOR_INFO c on b.AUTHOR_ID=c.AUTHOR_ID
			where contains(a.TITLE,?);";
		}
		
		//We will make sure $column is an expected column.  No Bobby Tables for my database...

		
		
		//For NON Author Output
		
		//$dbquery="SELECT top 50 * FROM EDITION_INFO_2 where ".$column."=?";
		
		
		$dbgetresults=$conn->prepare($dbquery);
		$dbgetresults->execute($params);
	
		//For NON Author output
	    //$dbresults=$dbgetresults->fetchAll(PDO::FETCH_ASSOC);
		//For Author output
		$dbresults=$dbgetresults->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
		
		$dbresultscount=count($dbresults);

		if ($dbresultscount==0) {
			include 'BookFunGenericQueryRESTful.php';
		}
		else {
			$curlresults=0;
		}
	}
	catch(Exception $e){
		print_r($e);
	}
//}
/*
else{
	$dbresultscount=0;
	include 'BookFunGenericQueryRESTful.php';
}
*/

;?>




