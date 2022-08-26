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
	<div id='introtext' class='textbox'>
	<p> I love to read.<br />
	<p>I also love to buy books. Lots and lots of books. This has led to me forgetting what I already have when I am browsing the shelves of my favorite local bookstore. It was around the time I bought my third copy of The Silmarillion that I realized that my library is way too big to keep track of in my head. Now, I could write down all of my books in the notes app on my phone or use an online library, but then I wouldn't be able to flex my technical muscles to create this!
	</p>
	
    Through this project, affectionately named "Encyclopedia Berb's Library Database" users can:</p>
	<ol>
		<li>Search the SQL database for books, using both Open Library and RESTful to find and compile information within the database</li>
		<li>Create an account to add books to a personal library, categorized by ownership and reading status </li>
		<li> Keep track of personal libraries and reading progress through the database </li>
	</ol>
	</div>
	<?php include("php-addons/LibrarySearchTableMark2.php");include("php-addons/standardjsimport.php");?>
	<script src="/js/searchoption.js"></script>
	
  </body>
</html>