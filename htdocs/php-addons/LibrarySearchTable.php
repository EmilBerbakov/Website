<html lang="en">
<form action="BookFunGenericSearchResults.php" method="post">
<script src='js/hideintro.js'></script>
	<div class="dropdown" onclick='hideintro()'>
		<button class="btn btn-dark dropdown-toggle" type="button" id="toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Start your search with one of the following: </button>
			<div class="dropdown-menu">
				<h6 class="dropdown-header" id="specific-header" aria-labelledby="toggle">ID Search</h6>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" type="button" id="ISBN10" onclick="SearchOption('ISBN10')">ISBN-10</button>
				<button class="dropdown-item" type="button" id="ISBN13" onclick="SearchOption('ISBN13')">ISBN-13</button>
				
				<!-- May add these back in, but Goodreads ID and Librarything ID are not ID types I expect people to search on.
				
				<button class="dropdown-item" type="button" id="GRID" onclick="SearchOption('GRID')">Goodreads ID</button>
				<button class="dropdown-item" type="button" id="LTID" onclick="SearchOption('LTID')">Librarything ID</button>
				
				I don't really expect people to search on Open Library ID, either, but I feel compelled to add this one.
				-->
				<button class="dropdown-item" type="button" id="OLID" onclick="SearchOption('OLID')">Open Library ID</button>
				<h6 class="dropdown-header" id="fuzzy-header">Name Search</h6>
				<div class="dropdown-divider"></div>
				
				<!-- Will add this in when WORK_TO_AUTHOR and/or EDITION_TO_AUTHOR are complete
				<button class="dropdown-item" type="button" id="author" onclick="SearchOption('author')">Author</button>
				-->
				<button class="dropdown-item" type="button" id="title" onclick="SearchOption('title')">Title</button>
			</div>
	</div><br/>
	<table id="searchoptions" style="display:none">
	<tr id="title-row">
		<th><label for="title-input" >Book Title:</label> </th>
		<td><input type="text" id="title-input" name='TITLE'></td>
	</tr>
	<!--
	<tr id="author-row">
		<th><label for "author-input" >Author:</label></th>
		<td><input type="text" id="author-input" name="AUTHOR"></td>
	</tr>
	-->
	<tr id="ISBN13-row">
		<th><label for="ISBN13-input" >ISBN-13:</label></th>
		<td><input type="text"
		id="ISBN13-input" maxlength="13" name="ISBN_13"></td>
	</tr>
	<tr id="ISBN10-row">
		<th><label for="ISBN10-input" >ISBN-10:</label></th>
		<td><input type="text" id="ISBN10-input" maxlength="10" name="ISBN_10"></td>
	</tr>
	<tr id="OLID-row">
		<th><label for "OLID-input" >Open Library ID:</label></th>
		<td><input type="text" id="OLID-input" name="EDITION_ID"></td>
	</tr>
	<!--
	<tr id="GRID-row">
		<th><label for "GRID-input" >Goodreads ID:</label></th>
		<td><input type="text" id="GRID-input" name="GR_ID"></td>
	</tr>
	<tr id="LTID-row">
		<th><label for "LTID-input" >Librarything ID:</label></th>
		<td><input type="text" id="LTID-input" name="LT_ID"></td>
	</tr>
	-->
	</table>
	<input type="submit" value="Search" style="display:none" onclick="return searchvalid()" id='searchbutton' class="btn btn-dark">
	</form>