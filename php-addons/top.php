<!--Added get_defined_vars.  It may be useful to keep an array of all varaibles at all times-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <!--Version 5.2-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


<link rel="icon" href=<?php echo $smallpicture; ?>>
	<title><?php echo $title; ?></title>
	<?php 
  if(isset($_SESSION['USER_ID_NUMBER'])==false){
    session_start();
  };
  $vars=get_defined_vars();?>