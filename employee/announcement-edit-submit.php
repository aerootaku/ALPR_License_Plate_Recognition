<?php 

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
include '../controller/connect.php';
//checking for incorrect input
if(isset($_GET['id'])) {
    $id = $_GET['id'];
//saving login state
$dtime=$_POST['dtime'];
$announcement=$_POST['announcement'];


$sqlupdate =("update tbl_announcements set announcements='$announcements', dtime='$dtime' where id='$id'");

	    if (!mysql_query($sqlupdate, $con)) {
        die('error: ' . mysql_error());
    }
}
		
	echo"<script> alert('Record Updated'); </script>
	  <script>window.location='announcements.php';</script>";
?>