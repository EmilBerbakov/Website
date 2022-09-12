  <style>
	th,td {
		text-align: right;
	}
	.textbox {
		width:75%;
	}
</style>
 <?php $title="Emil's Library Database";$smallpicture="icons/book.svg";include("php-addons/top.php");?>
 </head>
  <body>
	<h1>Encyclopedia Berb's Library Database</h1>
	<?php include("php-addons/toolbar.php");?> <br />
	<button id='texttogglebutton' class='btn btn-dark' type='button' data-bs-toggle='collapse' data-bs-target='#introtext' aria-expanded='true' aria-controls='introtext' onclick='texttoggle()'> Hide Intro </button>
	<div id='introtext' class='show collapse'>
	<div class="card border-light" style="width: 70rem">
	<div class='card-body'>
	<p > I love to read.</p>
	<p >I also love to buy books. Lots and lots of books. This has led to me forgetting what I already have when I am browsing the shelves of my favorite local bookstore. It was around the time I bought my third copy of The Silmarillion that I realized that my library is way too big to keep track of in my head. Now, I could write down all of my books in the notes app on my phone or use an online library, but then I wouldn't be able to flex my technical muscles to create this!
	</p>
	
    <p >Through this project, affectionately named "Encyclopedia Berb's Library Database" users can:</p>
	<p >
	<ol>
		<li>Search the SQL database for books, using both Open Library and RESTful to find and compile information within the database</li>
		<li>Create an account to add books to a personal library, categorized by ownership and reading status </li>
		<li> Keep track of personal libraries and reading progress through the database </li>
	</ol>
	</p>
	</div>
	</div>
	</div>
<br/>
	<?php include("php-addons/LibrarySearchTableMark2.php");include("php-addons/standardjsimport.php");?>
	
	
  </body>
</html>