<!-- Three things to be done with this:
1.) If the search was done through cURL, see if it exists in the database.  If not, add it.
2.) Check if USER_<USER_ID_NUMBER>_LIBRARY table exists.  If not, create it.
It will look like this:

EDITION ID | COUNT

For Searches, they will see TITLE and AUTHOR as well.

3.) Insert the entry into the table.  If the row already exists, add one to COUNT instead.

-->
<?php
session_start();
try{
include "php-addons/BookFunGenericConnection.php";


//to start, we will check if USER_$POST['USER_ID_NUMBER']_Library exists.  If it does, move one.
//else, create it

#print_r($_POST);
#print_r($_SESSION['USER_ID_NUMBER']);

/*
//Here is where we will put data into the database if the search fell back to the cURL method
if ($_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"]){
	$dbquery="SELECT TOP 1 EDITION_ID FROM EDITION_INFO_2 where EDITION_ID=?";
	foreach ($_SESSION[$_SESSION['USER_ID_NUMBER']."_CURLRESULTS"] as //something) {
		//loop through this and prep and send a query for each book.
		//if it doesn't exist, we'll add the ID, TITLE, ISBNs to the EDITION_INFO_2 table
}
*/
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

/*
When the add-book-to-database feature if results were from a cURL fallback is implemented, I can make EDITION_ID for the User's table a foreign key referencing EDITION_ID from EDITION_INFO_2
To add between Primary Key and end parenthesis

,CONSTRAINT fk_".$userlib."
FOREIGN KEY(EDITION_ID)
REFERENCES dbo.EDITION_INFO_2(EDITION_ID)

*/

$dbgetresults=$conn->prepare($dbquery);
$dbgetresults->execute();
}


catch (Exception $e) {
	print_r($e);
	include 'php-addons/ErrorMessage.php';
}
/*
//While I don't need the query to return anything at this point (I think), it may be something I need in the future, so let's keep this in as a reminder
$dbresults=$dbgetresults->fetchAll(PDO::FETCH_ASSOC);
*/


//Now we're working with the $_POST results.  
/*
each result is going to be:
Array[i] (
	[WANT]
	[OWN]
	[READ]
	[READING]
	[TBR]
	[DNF]
where i is the EDITION_ID.  If the option was selected, it will be set to on, otherwise it will be null.
So, first we want to see if either [WANT] or [OWN] is populated.  If it isn't, we will assume [WANT].
Next, we see if [READ],[READING],[TBR], or [DNF] are populated.  If not, we will assume [TBR].

Now we have the values.  I want to store these statues as ints, and then make a table that points the int representing the status.
Known issue: if you do not select a button in the button set for a particular book, it inherits the value of the one above it.
*/


try {
foreach($_POST as $edid=>$stats){
	if (count($stats)==2) {
		foreach ($stats as $substats) {
			switch($substats){
					case 'WANT':
						$ownership=1;
						break;
					case 'OWN':
						$ownership=2;
						break;
					case 'READ':
						$readstatus=1;
						break;
					case 'READING':
						$readstatus=2;
						break;
					case 'TBR':
						$readstatus=3;
						break;
					case 'DNF':
						$readstatus=4;
						break;
					
					
		}
		}
	
	//Note: Fix this by doing a prep and send.  No Bobby Tables, please.
	$dbquery="
	IF EXISTS (SELECT * FROM Libraries.".$userlib." where EDITION_ID='".$edid."')
	begin 
	IF EXISTS (SELECT * FROM Libraries.".$userlib." where EDITION_ID='".$edid."' and OWNERSHIP_STATUS=".$ownership." and READ_STATUS=".$readstatus.")
	begin
	UPDATE Libraries.".$userlib." set BOOK_NUM=BOOK_NUM+1 where EDITION_ID='".$edid."'
	end
	else
	begin
	UPDATE Libraries.".$userlib." set OWNERSHIP_STATUS=".$ownership.", READ_STATUS=".$readstatus." where EDITION_ID='".$edid."'
	end
	end
	
	else
	begin
	INSERT INTO Libraries.".$userlib." (EDITION_ID,OWNERSHIP_STATUS,READ_STATUS,BOOK_NUM) values ('".$edid."',".$ownership.",".$readstatus.",1)
	end
	";
	$dbgetresults=$conn->prepare($dbquery);
	$dbgetresults->execute();
	
	}
}
}
catch (Exception $e) {
	print_r($e);
	include 'php-addons/ErrorMessage.php';
}

header("Location: MyProfile.php")



;?>