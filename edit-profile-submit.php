<?php 
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
include 'controller/connect.php';

function dob ($birthday){
	list($day,$month,$year) = explode("/",$birthday);
	$year_diff  = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff   = date("d") - $day;
	if ($day_diff < 0 || $month_diff < 0)
		$year_diff--;
	return $year_diff;
}

//checking for incorrect input
if(isset($_GET['id'])) {
    $id = $_GET['id'];

//tbl_users_info
$sname=$_POST['surname'];
$fname=$_POST['firstname'];
$mname=$_POST['middlename'];


	// $bage = $_POST['birthday'];
	// $age = date('d/m/Y', strtotime(str_replace('-', '/', $bage)));
	// $age= dob($age);

$age=$_POST['age'];

$email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone']; 


//for profile upload
// $filetmp = $_FILES["file_img"]["tmp_name"];
// $filename = $_FILES["file_img"]["name"];
// $filepath = $_FILES["file_img"]["type"];
// $filepath  = "profile/".$filename;
// move_uploaded_file($filetmp,$filepath);

	$sqlupdate1 = ("update tbl_users_info set firstname='$fname', middlename='$mname',lastname='$sname',age='$age', contact='$phone',email='$email',address='$address' where id='$id'");
	    if (!mysql_query($sqlupdate1, $con)) {
        die('error: ' . mysql_error());
    }
 
 }

    echo"<script> alert('Record Updated'); </script>
	  <script>window.location='dashboard.php';</script>";
?>