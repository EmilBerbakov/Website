
<?php

try{
	$serverName="tcp:DESKTOP-T5POA74"; 
	$conn= new PDO("sqlsrv:server=$serverName;Database=Book_Fun","generic","sqlfun");
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT,5);
	$dbquery='SELECT * FROM USER_INFO WHERE EMAIL_ADDRESS=?';
	$dbresults=$conn->prepare($dbquery);
	$dbresults->execute(array($_POST['emailentry']));
}

catch (Exception $e) {
	die(print_r($e->getMessage()));
	}

$userresults = $dbresults->fetch();

if (isset($userresults["PASSWORD"])==False) {
	$_SESSION['LOGIN_ERROR']=1;
	header("location: ../index.php");
}
elseif(password_verify($_POST['passwordentry'],$userresults['PASSWORD'])){
	session_start();
	unset($_SESSION['LOGIN_ERROR']);
	$_SESSION['USER_ID_NUMBER']=$userresults['USER_ID_NUMBER'];
	$_SESSION['FIRST_NAME']=$userresults['FIRST_NAME'];
	//TO DO - reintroduce header('Location: '.$_SERVER['HTTP_REFERER']); so people can pick up where they left off.  I will need to prevent form resubmissions on reload in this case; otherwise, the search form may error out.

try{

$userlib='USER_'.$_SESSION['USER_ID_NUMBER'].'_LIBRARY';
$dbquery="
DECLARE @Result INT
if not exists (select * from sys.objects where object_id=OBJECT_ID(N'Libraries.".$userlib."') and type in (N'U'))
begin
create table Libraries.".$userlib."(
EDITION_ID varchar(50) not null,
OWNERSHIP_STATUS int not null,
READ_STATUS int not null,
BOOK_NUM int not null,
PRIMARY KEY(EDITION_ID),
FOREIGN KEY (READ_STATUS)
REFERENCES dbo.ZC_READING_STATUS(STATUS_ID),
FOREIGN KEY (OWNERSHIP_STATUS)
REFERENCES dbo.ZC_OWNERSHIP_STATUS(OWNERSHIP_ID)
)
end

else
begin
set @Result=2
end;

select @Result";

$dbgetresults=$conn->prepare($dbquery);
$dbgetresults->execute();

}

catch (Exception $e) {
	include 'php-addons/ErrorMessage.php';
	die();
}
	
	
	header("location: ../index.php");
}
else{
	$_SESSION['LOGIN_ERROR']=1;
	header("location: ../index.php");

}
?>