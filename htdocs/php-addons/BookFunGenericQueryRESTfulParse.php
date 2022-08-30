<?php
		$olid='key';
		$name='name';
		$isbn13='isbn_13';
		$isbn10='isbn_10';
		$title='title';
		$subtitle='subtitle';
		$authors='authors';
		$EDITIONID='EDITION_ID';
		$TITLE='TITLE';
		$SUBTITLE='SUBTITLE';
		$ISBN13='ISBN_13';
		$ISBN10='ISBN_10';
		$AUTHORNAME='AUTHOR_NAME';
		if (isset($curlresultsjson->$authors)){
			$authorcount=count($curlresultsjson->$authors);
		}
		else {
			$authorcount=0;
		}
		for ($key=0;$key<$authorcount;$key++){
		$titleval=$curlresultsjson->$title;
		$intermediate=explode('/',$curlresultsjson->$olid);
		$editionidval=end($intermediate);
		if(isset($curlresultsjson->$subtitle)) {
			$subtitleval=$curlresultsjson->$subtitle;
		}
		else {
			$subtitleval=Null;
		}
		if (isset($curlresultsjson->$isbn13)){
			$isbn13val=$curlresultsjson->$isbn13[0];
		}
		else {
			$isbn13val=Null;
		}
		if (isset($curlresultsjson->$isbn10)){
			$isbn10val=$curlresultsjson->$isbn10[0];
		}
		else {
			$isbn10val=Null;
		}
		if (isset($curlresultsjson->$authors[$key]->$olid)){
			//here we have to do a cURL request to get the author name
			//cURL openlibrary.org+$authorname+.json
			//grab content from "name" key
			$authorid=$curlresultsjson->$authors[$key]->$olid;
			$curl=curl_init();
			$options=array(CURLOPT_URL=>"http://openlibrary.org".$authorid.".json",CURLOPT_RETURNTRANSFER=>TRUE);
			curl_setopt_array($curl,$options);
			$curlreturn=curl_exec($curl);
			curl_close($curl);
			$curljson=json_decode($curlreturn);
			$authorname=$curljson->$name;
		}
		//$curlresults[]=array($TITLE=>$titleval,$SUBTITLE=>$subtitleval,$ISBN13=>$isbn13val,$ISBN10=>$isbn10val,$EDITIONID=>$editionidval);
		$curlresults[$editionidval][$key]=array($TITLE=>$titleval,$SUBTITLE=>$subtitleval,$ISBN13=>$isbn13val,$ISBN10=>$isbn10val,$AUTHORNAME=>$authorname);
	}
?>