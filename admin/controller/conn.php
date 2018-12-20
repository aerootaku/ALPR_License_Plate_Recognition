<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
	$server = "localhost";
	$username = "root";
	$pass = "";
	$dbname = "serialplates";


$servername = "localhost";
$username = "root";
$password = "";
	//create connection 

$link = mysql_connect($server, $username, $pass);
mysql_select_db($dbname, $link);

	$conn2 = mysqli_connect($server,$username,$pass,$dbname);
	$conn = mysqli_connect($server,$username,$pass,$dbname);
	$con = mysql_connect($server,$username,$pass,$dbname);
	//check conncetion

if ($conn2->connect_error) {
     die("Connection failed: " . $conn2->connect_error);
}  

	if($conn->connect_error){

		die ("Connection Failed!". $conn->connect_error);
	}
	
	if(!$con){

		die ("Connection Failed!". mysql_error());
	}


	
?>