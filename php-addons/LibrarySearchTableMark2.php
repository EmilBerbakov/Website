<form action="BookFunGenericSearchResults.php" method="post">
<script src='js/searchoptions2.js'></script>
<!--visibilityswitch() will take an input of an array, then the js funtion will swap the visibility of the elements in said array-->
<table id='searchoptions'>
	<tr>
<th><div class='dropdown'>
	<button class='btn btn-dark dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false' id='mainbutton' value='None'> Start your search with one of the following:</button>
	<div class="dropdown-menu dropdown-menu-dark">
				<h6 class="dropdown-header" id="specific-header" aria-labelledby="toggle">ID Search</h6>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" type="button" id="ISBN_10" onclick="searchswitch(this.id)">ISBN-10</button>
				<button class="dropdown-item" type="button" id="ISBN_13" onclick="searchswitch(this.id)">ISBN-13</button>
				
				<!-- May add these back in, but Goodreads ID and Librarything ID are not ID types I expect people to search on.
				
				<button class="dropdown-item" type="button" id="GRID" onclick="SearchOption('GRID')">Goodreads ID</button>
				<button class="dropdown-item" type="button" id="LTID" onclick="SearchOption('LTID')">Librarything ID</button>
				
				I don't really expect people to search on Open Library ID, either, but I feel compelled to add this one.
				-->
				<button class="dropdown-item" type="button" id="EDITION_ID" onclick="searchswitch(this.id)">Open Library ID</button>
				<h6 class="dropdown-header" id="fuzzy-header">Name Search</h6>
				<div class="dropdown-divider"></div>
				
				<!-- Will add this in when WORK_TO_AUTHOR and/or EDITION_TO_AUTHOR are complete
				<button class="dropdown-item" type="button" id="author" onclick="SearchOption('author')">Author</button>
				-->
				<button class="dropdown-item" type="button" id="TITLE" onclick="searchswitch(this.id)">Title</button>
			</div>
	</div></th>
	<th><input type='text' name='None' id='searchvalue' style="display:none" onkeyup="visibilityswitch(this.id,'searchbutton')"></th>
	<th><input type="submit" value="Search" style="display:none"  id='searchbutton' class="btn btn-dark" disabled>
</tr>
</table>
</form>
	
	