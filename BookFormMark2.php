 <?php $title="Emil's Library Database";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
 <style>
	th,td {
		text-align: right;
	}
</style>
  <body>
	<form action="BookFunGenericSearchResults.php" method="post">
	<h1>Encyclopedia Berb's Library Database</h1>
	<?php include("php-addons/toolbar.php");?> <br />
	<div id='introtext'>
	<p> I love to read.<br />
	I also love to buy books.  Lots and lots of books.  This has led to me forgetting what I own when I see something at the bookstore that I just <i>need</i> to have.<br />
	It was around the time I bought my second or third copy of the Silmarillion that I realized something: my library is getting way too big to just keep track of in my head.<br />
	Now, I could have just written down all of my books in a note on my phone, or kept track of them through some online database, but then I wouldn't have been able to flex my technical muscles to create this, now would I have?<br />
    And what is this, exactly?  Well, currently, it is a proof of concept that allows me to search for any work of liturature and any edition of said works.  In the long term, this is the goal of this project, affectionately dubbed "Encyclopedia Berb's Library Database"</p>
	<ol>
		<li>Search for any book based on the parameters listed in the search box below</li>
		<li>Allow myself and others who access this site the ability to create and maintain their own library through either manual entry through the site or mass import.</li>
		<li>In the same vein as number 2: allow for account creation so that personal libraries created through this project can persist. </li>
	</ol>
	</div>
	<?php include("php-addons/LibrarySearchTable.php");include("php-addons/standardjsimport.php");?>
	<script src="/js/searchoption.js"></script>
	
  </body>
</html>