<!--These are the two columns that only appear if you're logged in.  These columns allow you to add entries to your library-->
<!--Known issue, checkboxes need to be manually de-selected.  If they are not, then the bottom-most option is submitted.  Planning on writing an on-click script that deselects relevant options-->

<td>
<div class="btn-group btn-group-toggle" data-toggle="buttons" id="<?php echo $edid;?>-WO" >
  <label class="btn btn-dark">
    <input type="checkbox" name="<?php echo $edid;?>[OWNERSHIP]" value='WANT' id="<?php echo $edid;?>-WANT" autocomplete="off"> Want
  </label>
  <label class="btn btn-dark">
    <input type="checkbox" name="<?php echo $edid;?>[OWNERSHIP]" value='OWN' id="<?php echo $edid;?>-OWN" autocomplete="off"> Own
  </label>
</div>
</td>
<td>
<div class="btn-group btn-group-toggle" data-toggle="buttons" id="<?php echo $edid;?>-RRTB">
	<label class="btn btn-dark">
	    <input type="checkbox" name="<?php echo $edid;?>[READSTATUS]" value='READ' id="<?php echo $edid;?>-READ" autocomplete="off"> Read
	</label>
	<label class="btn btn-dark">
	<input type="checkbox" name="<?php echo $edid;?>[READSTATUS]" value='READING' id="<?php echo $edid;?>-READING" autocomplete="off"> Reading
	</label>
	<label class="btn btn-dark">
	<input type="checkbox" name="<?php echo $edid;?>[READSTATUS]" value='TBR' id="<?php echo $edid;?>-TBR" autocomplete="off"> TBR
	</label>
	<label class="btn btn-dark">
	<input type="checkbox" name="<?php echo $edid;?>[READSTATUS]" value='DNF' id="<?php echo $edid;?>-DNF" autocomplete="off"> DNF
	</label>
</td>