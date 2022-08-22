function SearchOption(optionid){
	var table=document.getElementById('searchoptions');
	var rowid=optionid+'-row';
	var searchop=document.getElementById(rowid);
	var searchbutton=document.getElementById('searchbutton');
	for (var i=0,row;row=table.rows[i]; i++) {
		checkid=row.id;
		if (checkid==rowid) {
			row.style.display="initial";
			searchbutton.style.display="initial";
		}
		else {
			strippedid=checkid.split('-')[0]
			row.style.display="none"
			clearcheck=document.getElementById(strippedid+'-input');
			if (clearcheck !== null) {
				clearcheck.value=null;
			}
		}
	}
	table.style.display="initial";
	
}

function searchvalid() {
	var table=document.getElementById('searchoptions');
	
	for (var i=0,row;row=table.rows[i];i++) {
		checkid=row.id;
		var hiddenyn=row.style.display;
		var visible=0;
		if (hiddenyn=="initial") {
			visible=1;
			strippedid=checkid.split('-')[0];
			/*
			if (strippedid=='ISBN10' | strippedid=='ISBN13') {
					
			}
			*/
			var inputval=document.getElementById(strippedid+'-input').value;
			/*
			switch (inputval):
				case inputval=='':
				case ((strippedid=='ISBN13') |
			*/
			if (inputval=="") {
				alert("Enter a search value");
				return false;
			}
			else {
				return true;
			}
			
		}
	}
	if (visible==0) {
			alert("Please select a search value");
			return false;
	}
}
			
