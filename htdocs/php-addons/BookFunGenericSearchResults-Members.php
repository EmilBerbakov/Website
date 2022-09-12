<!--These are the two columns that only appear if you're logged in.  These columns allow you to add entries to your library-->
<!--Known issue, checkboxes need to be manually de-selected.  If they are not, then the bottom-most option is submitted. (ie if want and own are clicked on, own is submitted.)  Planning on writing an on-click script that deselects relevant options (ie if I click want, deselect own)-->

<td>
<div class="btn-group" role='group' id="<?php echo $edid;?>-WO" >
    <input type="checkbox" class='btn-check' name="<?php echo $edid;?>[OWNERSHIP]" value='WANT' id="<?php echo $edid;?>-WANT" autocomplete="off"> 
	<label class="btn btn-dark" for="<?php echo $edid;?>-WANT">Want</label>
  
    <input type="checkbox" class='btn-check' name="<?php echo $edid;?>[OWNERSHIP]" value='OWN' id="<?php echo $edid;?>-OWN" autocomplete="off">
	<label class="btn btn-dark" for="<?php echo $edid;?>-OWN">Own</label>
</div>
</td>
<td>
<div class="btn-group" role="group" id="<?php echo $edid;?>-RRTB">
	    <input type="checkbox" class='btn-check' name="<?php echo $edid;?>[READSTATUS]" value='READ' id="<?php echo $edid;?>-READ" autocomplete="off"> 
		<label class="btn btn-dark" for="<?php echo $edid;?>-READ">Read</label>
	
	<input type="checkbox" class='btn-check' name="<?php echo $edid;?>[READSTATUS]" value='READING' id="<?php echo $edid;?>-READING" autocomplete="off">
	<label class="btn btn-dark" for="<?php echo $edid;?>-READING">Reading</label>
	
	<input type="checkbox" class='btn-check' name="<?php echo $edid;?>[READSTATUS]" value='TBR' id="<?php echo $edid;?>-TBR" autocomplete="off"> 
	<label class="btn btn-dark" for="<?php echo $edid;?>-TBR">TBR</label>
	
	<input type="checkbox" class='btn-check' name="<?php echo $edid;?>[READSTATUS]" value='DNF' id="<?php echo $edid;?>-DNF" autocomplete="off">
	<label class="btn btn-dark" for="<?php echo $edid;?>-DNF">DNF</label>
</td>