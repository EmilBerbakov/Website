<?php 
$serverName="tcp:127.0.0.1g"; 
$conn= new PDO("sqlsrv:server=$serverName;Database=Book_Fun","generic","sqlfun");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//Unless this is not set to true, db searches take a while;
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
//$conn->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT,10);
;?>
