<?php
		$olid='key';
		$isbn13='isbn_13';
		$isbn10='isbn_10';
		$title='title';
		$subtitle='subtitle';
		$EDITIONID='EDITION_ID';
		$TITLE='TITLE';
		$SUBTITLE='SUBTITLE';
		$ISBN13='ISBN_13';
		$ISBN10='ISBN_10';
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
		$curlresults[]=array($TITLE=>$titleval,$SUBTITLE=>$subtitleval,$ISBN13=>$isbn13val,$ISBN10=>$isbn10val,$EDITIONID=>$editionidval);
		#$fn++;
?>