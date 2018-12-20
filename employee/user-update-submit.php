<?php 
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
include '../controller/connect.php';
//checking for incorrect input
if(isset($_GET['id'])) {
    $id = $_GET['id'];
//saving login state
$username=$_POST['username'];
$password=$_POST['password'];

//tbl_users_info
$sname=$_POST['surname'];
$fname=$_POST['firstname'];
$mname=$_POST['middlename'];
$age=$_POST['age'];
$bday=$_POST['birthday'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$plate=$_POST['plate'];
$color=$_POST['color'];
$chassis=$_POST['chassis'];
$engine_num=$_POST['engine_num'];
$year_model=$_POST['year_model'];
$mv_type=$_POST['mv_type'];
$mv_file=$_POST['mv_file'];
$make=$_POST['make'];
$cr_no=$_POST['cr_no'];
$or_no=$_POST['or_no'];

//for profile upload
$filetmp = $_FILES["file_img"]["tmp_name"];
$filename = $_FILES["file_img"]["name"];
$filepath = $_FILES["file_img"]["type"];
$filepath  = "profile/".$filename;
move_uploaded_file($filetmp,$filepath);

	$sqlupdate1 = ("update tbl_users_info set profile='$filepath', firstname='$fname', middlename='$mname',lastname='$sname',age='$age',gender='$gender',birthday='$bday',contact='$phone',email='$email',address='$address',platenumber='$plate', color='$color', mv_file='$mv_file', chassis='$chassis', engine_num='$engine_num', year_model='$year_model',mv_type='$mv_type',make='$make', or_no='$or_no',cr_no='$cr_no' where id='$id'");
	    if (!mysql_query($sqlupdate1, $con)) {
        die('error: ' . mysql_error());
    }

    $sqlinsertloginupdate=("update tbl_users set username='$username',password='$password' where id='$id'");

    if (!mysql_query($sqlinsertloginupdate, $con)) {
        die('error: ' . mysql_error());
    }
 }

    echo"<script> alert('Record Updated'); </script>
	  <script>window.location='user-list.php';</script>";
?>