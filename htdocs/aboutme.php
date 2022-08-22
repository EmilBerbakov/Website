 <?php $title="About Me";$smallpicture="icons/question-circle.svg";include("php-addons/top.php");?>
 <style>
 img {
	width:10%;
	height:auto;
	vertical-align:top;
 }
 
 .textcontent {
	display:inline-block;
	width:30%;
	white-space:normal;

 }
 .stuff {
	width:100%
	margin:auto;
	white-space: nowrap
 }

 </style>
 </head>
 <body>
 <h1> All About Me </h1>
 <?php include("php-addons/toolbar.php");?> <br />
 <div class="stuff">
 <!--<div style="display:inline-block;";>-->
 <img src='icons/MyPortrait.jpg' />
 <!--<div style="display:inline-block";>-->
 <div class="textcontent">
 <p>Hello and welcome to my page! My name is Emil, (pronounced "AY-mull"). I also respond to "Eh-mull", "EE-mull", "Eh-meal", and anything in-between.</p>
 <p>Over the past five years, I have held positions in the fields of engineering and information technology. I have a passion for the integration of creativity and functionality: creating things that work well and look better. </p>
 <p>I was born and raised in Philadelphia, Pennsylvania. I currently live in Madison, Wisconsin with my wife, Maria, and our two cats, Buzz and Woody. I enjoy drinking coffee, going on long drives, playing video games, making music, and, of course, reading a good book.</p>
 </div>
 </div>
 <?php include("php-addons/standardjsimport.php");?>
 </body>