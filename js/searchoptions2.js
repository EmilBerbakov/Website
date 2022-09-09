function visibilityswitch(sourceid,idoption) {
	var searchval=document.getElementById(sourceid).value??" ";
	var searchvalclean=searchval.trim();
	var submitbutton=document.getElementById(idoption);
	if ((searchvalclean=="")) {
		submitbutton.disabled=true;
		submitbutton.style.display='none';
	}
	else {
		submitbutton.disabled=false;
		submitbutton.style.display='initial';
	}

}

function searchswitch(nameoption) {
	var ddbutton=document.getElementById('mainbutton');
	var ddbuttonoptions=document.getElementById(nameoption);
	var searchbox=document.getElementById('searchvalue');
	searchbox.setAttribute('name',nameoption);
	searchbox.style.display='initial';
	ddbutton.innerText=ddbuttonoptions.innerText;
	
}

function texttoggle(){
	var card=document.getElementById('introtext')
	var button=document.getElementById('texttogglebutton')
	if (button.classList.contains('collapsed')){
		button.innerText='Show Intro'
	}
	else {
		button.innerText='Hide Intro'
	}

}