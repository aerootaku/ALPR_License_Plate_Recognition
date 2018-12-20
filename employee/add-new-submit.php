<?php 
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);
include '../controller/connect.php';
//checking for incorrect input
            date_default_timezone_set("Asia/Manila");
            
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
$cdate=$_POST['cdate'];
for profile upload
$filetmp = $_FILES["file_img"]["tmp_name"];
$filename = $_FILES["file_img"]["name"];
$filepath = $_FILES["file_img"]["type"];
$filepath  = "../profile/".$filename;
move_uploaded_file($filetmp,$filepath);
if($sname!='' && $fname!='' && $mname!='' && $age!='' && $bday!='' && $gender!='' && $email!='' && $address!='' && $phone!='' && $plate!='')

{

	$sqlinsert = ("insert into tbl_users_info(profile,firstname,middlename,lastname,age,gender,birthday,contact,email,address,platenumber,cdate,color,mv_file,chassis,engine_num,year_model,mv_type, make, or_no, cr_no) 
        values('$profile', '$fname','$mname','$sname','$age','$gender','$bday','$phone','$email','$address','$plate','$cdate','$color','$mv_file','$chassis','$engine_num','$year_model','$mv_type','$make','$or_no','$cr_no') ");
	    if (!mysql_query($sqlinsert, $con)) {
        die('error: ' . mysql_error());
    }

    $userS_query=mysql_query("select * from tbl_users_info order by id DESC LIMIT 1")or die(mysql_error());
									while($row=mysql_fetch_array($userS_query)){
									
									$id=$row['id'];

    $sqlinsertlogin=("insert into tbl_users(id,username,password) values('$id','$username','$password')");
}
    if (!mysql_query($sqlinsertlogin, $con)) {
        die('error: ' . mysql_error());
    }

    echo"<script> alert('New Record Added'); </script>
	<script>window.location='user-list.php?page';</script>";
}
else
{
	echo"<script>alert('Error, Fill all the required field')</script>
         <script>location.replace='add-new.php'</script>";
}
?>