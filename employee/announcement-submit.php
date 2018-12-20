<?php 

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
include '../controller/connect.php';
//checking for incorrect input

//saving login state
$dtime=$_POST['dtime'];
$announcement=$_POST['announcement'];


$sqlinsert = ("insert into tbl_announcements(announcements,dtime) values('$announcement','$dtime')");
	    if (!mysql_query($sqlinsert, $con)) {
        die('error: ' . mysql_error());
    }
?>