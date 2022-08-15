<?php 
$serverName="tcp:DESKTOP-T5POA74"; 
#$connectionInfo=array("Database"=>"Book_Fun", "UID"=>"generic","PWD"=>"sqlfun");
#$conn=sqlsrv_connect($serverName,$connectionInfo);
try{
$conn= new PDO("sqlsrv:server=$serverName;Database=Book_Fun","generic","sqlfun");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	die(print_r($e->getMessage()));
}
?>
<br />