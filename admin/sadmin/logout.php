<?php
	error_reporting(E_ALL ^ E_NOTICE);
	error_reporting(E_ALL ^ E_DEPRECATED);
	header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
date_default_timezone_set('Asia/Manila');
include '../controller/connect.php'; 
	$dt =  date('Y-m-d h:i:s'); 
	session_start();
	$user_adminID = $_SESSION['id'];


	$action="Logged-out.";
	$user_adminID=$_SESSION['id'];
$sql=("INSERT INTO tbl_logs(user_adminID, action, dt) VALUES ('$user_adminID', '$action', '$dt')");
 	(mysqli_query($conn, $sql)); 

	if(session_destroy()){
		header("Location: ../index.php");
	}
?>