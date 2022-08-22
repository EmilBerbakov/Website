<?php $title="Login";$smallpicture="icons/bookicon.png";include("php-addons/top.php");?>
</head>
<body>
<h1 id="createaccountheader">Create an Account</h1>
<?php include("php-addons/toolbar.php");include("php-addons/standardjsimport.php");?>
<?php

$pass=password_hash($_POST['passwordcreate1'],PASSWORD_DEFAULT);
$serverName="tcp:DESKTOP-T5POA74"; 
try{
	$conn= new PDO("sqlsrv:server=$serverName;Database=Book_Fun","generic","sqlfun");
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT,5);
	$dbquery='INSERT INTO USER_INFO (EMAIL_ADDRESS,FIRST_NAME,LAST_NAME,PASSWORD) VALUES (?,?,?,?)';
	$dbresults=$conn->prepare($dbquery);
	$dbresults->execute(array($_POST['emailcreate'],$_POST['firstnamecreate'],$_POST['lastnamecreate'],$pass));
}
	catch(Exception $e) {
			if ($e->getCode()==23000) {
				die('There is already an account registered with this email.<br/>');
			}
			else {
				//die(print_r($e->getMessage()));
				include 'php-addons/ErrorMessage.php';
	}
	}
	echo "Account created successfully.  Welcome aboard, ".$_POST['firstnamecreate']."!<br/> 
				<form action='BookFormMark2.php' method='post'>
				<input type='submit' value='To Library Database' id='lbback' class='btn btn-dark'>
				</form>";


;?>
<?php include("php-addons/standardjsimport.php");?>
