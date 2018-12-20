<?php 
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
include 'controller/connect.php';
//checking for incorrect input

    $id = $_POST['carID'];
$platenumber=$_POST['platenumber'];
	$color=$_POST['color'];
	$chassis=$_POST['chassis'];
	$engine_num=$_POST['engine_num'];
	$year_model=$_POST['year_model'];
	$mv_type=$_POST['mv_type'];
	$mv_file=$_POST['mv_file'];
	$make=$_POST['make'];
	$cr_no=$_POST['cr_no'];
	$or_no=$_POST['or_no'];

	$sql = ("UPDATE  tbl_cars  SET  platenumber='$platenumber', color='$color', mv_file='$mv_file', chassis='$chassis', engine_num='$engine_num', year_model='$year_model',mv_type='$mv_type',make='$make', or_no='$or_no',cr_no='$cr_no' where id='$id'"); 
if (!mysql_query($sql, $con)) {
        die('error: ' . mysql_error());
    }
 
 

    echo"<script> alert('Record Updated'); </script>
	  <script>window.location='dashboard.php';</script>";
?>