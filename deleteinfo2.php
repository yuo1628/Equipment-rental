<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_in.php");
	$number = $_GET["number"];
	$query = sprintf("DELETE FROM lend WHERE number='%s'", $number);
	mysqli_query($db, $query) or die(mysqli_error());
	header("Location:member2.php");
	
	$number = $_GET["number"];
	$query = sprintf("UPDATE history SET ps ='駁回' WHERE number='".$_GET['number']."'");
	
	mysqli_query($db, $query) or die(mysqli_error());
	header("Location:member2.php");
	
	$number = $_GET["number"];
	$query = sprintf("UPDATE indata SET status = '' WHERE number = '".$_GET['number']."'"); 
	
	mysqli_query($db, $query) or die(mysqli_error());
	header("Location:member2.php");
	
	$number = $_GET["number"];
    $query = sprintf("UPDATE indata SET NY = '' WHERE number = '".$_GET['number']."'"); 
	
	mysqli_query($db, $query) or die(mysqli_error());
	header("Location:member2.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>
<body>
</body>
</html>