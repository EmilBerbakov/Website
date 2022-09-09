/* This routine will be fed 2 imputs.
Input 1 - Required:
	1 - unhide submit Button
	2 - hide and disable submit Button
	3 - enable button if unhidden
Input 2 - Required:
	OL_ID - Open library ID of the work you want to add to your library
Input 3 - Required:
	Selection Type - indicates what option the user pressed.
	*/
	
/*
Alright, what are we doing here?

The submit button is hidden and disabled to start.
Pressing Want or Own should make the button unhide.
Pressing Neither Disables the button.  It should also disable the read options.

Now, we go to the next set of buttons:

h/w    R/s
have	read
want    reading
N/A     TBR
        DNF
        N/A
		
Option 1 - user selects h/w N/A:
		deselect all options in R/S, rename everything except the NAs back to the generic names
		select RS NA and disable everything else in the RS column
		Name NAs to HW-NA and RS-NA; for form submission, we will ignore all row instances of HW-NA + RS-NA $_POST values
Option 2 - user selects have or want in HW:
        deselect and disable N/A.  Default RS option to read. rename everything to generic names and change the name of your selected option to a unique option
Option 3 - user selects RS NA:
		deselect all options in HW and select HW NA.  Disable all other options in RS.  Rename the NAs to a unique name, generic for the others.
		
When checking for submit legit-ness, the only good options are:
	1.) HW is have or want, then anything but NA in RS
	2.) disable button if both options are NA (or just go to the query page and have a quit statement in it that redirects you back to the previous page.
	
         


Potentially use the .children().prop('disabled',true) on the divs to disable all nonnas and nas at once, respectively

*/
/*	
function unhide(flag,hwname,rsname,pressedid) {
	var bookid=rsname.split('-')[0];
	var rsna=document.getElementById(bookid+'-RSNA');
	var hwna=document.getElementById(bookid+'-HWNA');
	var hwnonna=document.getElementById(bookid+'-HW-NONNA');
	var hwnonnachild=hwnonna.getElementsByTagName('input');
	var pressedele=document.getElementById(pressedid);
	var rsnonna=document.getElementById(bookid+'-RS-NONNA');
	var rsnonnachild=rsnonna.getElementsByTagName('input');

	//use hwnonna / hwna.contains(pressid) to see if we hit a non-NA answer or not
	var submitbutton= document.getElementById('libadd');
	//var ownoption
	//var readoption
	
	switch(flag) {
		case 2:
		
			for(i=0;i<rsnonnachild.length;i++) {
				ele=rsnonnachild[i];
				if (ele.checked==true){
					ele.click()
					ele.checked=false;
				}
				ele.disabled=true;
				ele.setAttribute('name',rsname);
			}
			for (i=0;i<hwnonnachild.length;i++){
				ele=hwnonnachild[i];
				ele.setAttribute('name',rsname);
				if (ele.checked==true) {
					ele.click()
					ele.checked=false;
				}
			}
			pressedele.setAttribute('name',pressedid);
			break
			
		case 1:
			document.getElementById(bookid+'-HWNA').setAttribute('name',hwname);
			document.getElementById(bookid+'-HWNA').checked=false;
			for(i=0;i<rsnonnachild.length;i++){
				ele=rsnonnachild[i];
				ele.disabled=false;
			}
			if (rsna.checked){
				rsna.setAttribute('name',rsname);
				rsna.click();
			}

			for(i=0;i<hwnonnachild.length;i++) {
				ele=hwnonnachild[i];
				if (ele!=pressedele){
					ele.setAttribute('name',hwname);
					if (ele.checked==true){
						ele.checked=false;
						ele.click();
					}
				}
				
			}
			pressedele.setAttribute('name',pressedid);
			break
	}
if ((rsna.checked==false)&(hwna.checked==false)){
	submitbutton.disabled=false;
}
else {
	submitbutton.disabled=true;
}

}
*/

function submitokay() {
	var table=document.getElementById('searchresults');
	for (var i=0,row;row=table.rows[i];i++) {
		//look at each row's "<?php echo $edid;?>-WO" and id="<?php echo $edid;?>-RRTB" div
		//Compare accross the row
		//fail state is if one div in the row has an active button and the other does not
		
	}