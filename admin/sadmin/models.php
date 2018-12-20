<?php 
include '../controller/connect.php'; 

date_default_timezone_set("Asia/Manila");
$dt =  date('Y-m-d- H:i A'); 
$gendt= date('Ymd');
//$users_infoID=$_SESSION['id'];  


//User Admin 
if ($_GET['do']=='updateUserAdmin') {
	$id = $_GET['id'];

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = ($_POST['password']);
 

  /*  if ($password != '' || $name != '') // check if the password field is empty
    {*/
    	$sql = ("UPDATE tbl_users SET name='$name', username='$username', password='$password' where id='$id'");
    	(mysqli_query($conn, $sql)); 
    	echo "<script> alert('Information successfully updated'); </script>";
    	echo " <script>window.location = 'users-admin.php'</script>";
  

    // }
    // else {
    // 	echo "<script>alert('Password not match')</script>";
    // 	echo " <script>window.location = 'pw-updatepassword.php?id=$xid'</script>";
    // }
    

}



function dob ($birthday){
	list($day,$month,$year) = explode("/",$birthday);
	$year_diff  = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff   = date("d") - $day;
	if ($day_diff < 0 || $month_diff < 0)
		$year_diff--;
	return $year_diff;
}
 
if ($_GET['do']=='deleteUserAdmin') {
	$id = $_GET['id'];

	$sql=("SELECT type FROM tbl_users WHERE id='$id' ");
	$data=mysqli_query($conn,$sql);   
	if($row=mysqli_fetch_array($data)){ 

		$type=$row['type'];
		if ($type=='Admin') { 
			$sql = "DELETE from tbl_users where id = '$id'";
		(mysqli_query($conn, $sql));
		$message = " User Successfully deleted.";
		  echo "<script type='text/javascript'>alert('$message');window.location.href='users-admin.php';</script>";
		exit();
		} else {
			$sql = "DELETE from tbl_users where id = '$id'";
		(mysqli_query($conn, $sql));
		$message = " User Successfully deleted.";
		  echo "<script type='text/javascript'>alert('$message');window.location.href='users-admin.php';</script>";
		exit();
		} 
	} 
}


if ($_GET['do']=='addUserAdmin') {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$type = $_POST['type'];


	$sql=("SELECT * FROM tbl_users WHERE username='$username'");
	$data=mysqli_query($conn,$sql);   
	if($row=mysqli_fetch_array($data)){ 
		$message = "Username is already used.";
		echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
		exit();  
	} else { 
		$sql = ("insert into tbl_users(name,username,password,type) values('$name','$username','$password','$type')");
		mysqli_query($conn, $sql) ;
		echo "<script> alert('New User Added'); </script>";
		echo " <script>window.location = 'users-admin.php'</script>";
	}

}



//Vehicle Owners CRUDS
if ($_GET['do']=='addUser') {
//saving login state
	$username=$_POST['username'];
	$password=md5($_POST['password']);

//tbl_users_info
	$sname=$_POST['surname'];
	$fname=$_POST['firstname'];
	$mname=$_POST['middlename'];
	$bday=$_POST['birthday'];

	$bage = $_POST['birthday'];
	$age = date('d/m/Y', strtotime(str_replace('-', '/', $bage)));
	$age= dob($age);

	if ($age<18) {
		$message = "Age is invalid.";
		echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
		exit(); 
	}

	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$cdate=$_POST['cdate'];
	$phne=$_POST['phne'];
	$type="user";
 

	$temp = $_FILES["imgUrl"]["tmp_name"]; 
	$filename = $_FILES["imgUrl"]["name"]; 
	move_uploaded_file($temp,"profile/".$filename);


 $filename="profile/".$filename;
	$sql=("SELECT * FROM tbl_users WHERE username='$username'");
	$data=mysqli_query($conn,$sql);   
	if($row=mysqli_fetch_array($data)){ 
		$message = "Username is already used.";
		echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
		exit();  
	} else {  
		$sql = ("INSERT INTO tbl_users_info(profile,firstname,middlename,lastname,age,gender,birthday,contact,email,address,cdate,username, phne) 
			VALUES ('$filename', '$fname','$mname','$sname','$age','$gender','$bday','$phone','$email','$address','$cdate','$username','$phne') ");
		mysqli_query($conn, $sql) ;
 
	$fullname=$fname.' '.$mname.' '.$sname;

		$sql=("INSERT into tbl_users(name,username,password,type) values('$fullname','$username','$password','$type')");
	mysqli_query($conn, $sql) ;
		$message = "New Record Added.";	
	} 
	echo "<script type='text/javascript'>alert('$message');window.location.href='user-list.php';</script>";
	exit();  
}

if ($_GET['do']=='updateUser') {
	$id = $_GET['id'];
//saving login state
	$username=$_POST['username'];
	$password=md5($_POST['password']);

//tbl_users_info
	$sname=$_POST['surname'];
	$fname=$_POST['firstname'];
	$mname=$_POST['middlename']; 

	$bday=$_POST['birthday'];

	$bage = $_POST['birthday'];
	$age = date('d/m/Y', strtotime(str_replace('-', '/', $bage)));
	$age= dob($age);

	$gender	=$_POST['gender'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$phone=$_POST['phone']; 
	$imgUrlE=$_POST['imgUrlE']; 
	$phne = $_POST['phne'];

//for profile upload
	$temp = $_FILES["imgUrl"]["tmp_name"]; 
	$filename = $_FILES["imgUrl"]["name"]; 
	move_uploaded_file($temp,"profile/".$filename);	

	if ($filename="") {
$filename=$imgUrlE;
	} 

	$sql = ("update tbl_users_info set profile='$filename', firstname='$fname', middlename='$mname',lastname='$sname',age='$age',gender='$gender',birthday='$bday',contact='$phone',email='$email',address='$address',username='$username', phne='$phne' where id='$id'");
	mysqli_query($conn, $sql) ;


	$sql=("update tbl_users set username='$username',password='$password' where id='$id'");
	mysqli_query($conn, $sql) ; 

	$message = "Record Updated.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='user-list.php';</script>";
	exit();  
}



if ($_GET['do']=='deleteUser') {
	$id = $_GET['id'];

	$sql = "delete from tbl_users_info where id = '$id'";
	(mysqli_query($conn, $sql));

	$sql = "delete from tbl_users where id = '$id'";
	(mysqli_query($conn, $sql));

	$message = "User Successfully deleted.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='user-list.php';</script>";
	exit();   
}

if ($_GET['do']=='activationSubmit') {
	$id = $_GET['id']; 
	$activate_string = "0";
	$sql = "update tbl_users set logattempt='$activate_string' where username = '$id'";
	mysqli_query($conn, $sql) ;
	$message = "User Successfully Activated.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='user-list.php';</script>";
	exit(); 
}


 //Car CRUDS
if ($_GET['do']=='deleteCar') {
	$id = $_GET['id']; 
	$sql = "delete from tbl_cars where id = '$id'";
	(mysqli_query($conn, $sql));
	$message = "Car Successfully Deleted.";
	echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
	exit();
}
if ($_GET['do']=='addCar') {
	$id = $_POST['id']; 
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

	$sql=("SELECT * FROM tbl_cars WHERE platenumber='$platenumber'");
	$data=mysqli_query($conn,$sql);   
	if($row=mysqli_fetch_array($data)){ 
		$message = "Car is exist";
		echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
		exit();  
	} else {

		$sql="INSERT INTO tbl_cars(users_infoID, platenumber,  cdate, color, mv_file, chassis, engine_num, year_model, mv_type, make, or_no, cr_no) VALUES ('$id', '$platenumber', '$dt', '$color', '$mv_file', '$chassis', '$engine_num', '$year_model', '$mv_type', '$make', '$or_no', '$cr_no')";
		(mysqli_query($conn, $sql));
		$message = "Car Successfully Added.";
		echo "<script type='text/javascript'>alert('$message');window.location.href='user-list.php';</script>";
		exit();
	}

}

if ($_GET['do']=='updateCar') {
	$id = $_GET['id']; 
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
	(mysqli_query($conn, $sql));
	$message = "Car Successfully Updated.";
	echo "<script type='text/javascript'>alert('$message');history.go(-2);</script>";
	exit();
}


//Announcement
if ($_GET['do']=='addAnn') { 
	$announcement=$_POST['announcement']; 
	$sql = ("insert into tbl_announcements(announcements,dtime) values('$announcement','$dt')");
	(mysqli_query($conn, $sql));
	$message = "Announcement successfully added.";
	echo "<script type='text/javascript'>alert('$message'); window.location.href='announcements.php';</script>";
	exit();
}
if ($_GET['do']=='updateAnn') {  
	$id = $_GET['id'];
	$announcement=$_POST['announcement']; 
	$sql =("update tbl_announcements set announcements='$announcement', dtime='$dt' where id='$id'");
	(mysqli_query($conn, $sql));
	$message = "Announcement successfully updated.";
	echo "<script type='text/javascript'>alert('$message'); window.location.href='announcements.php';</script>";
	exit();
}
if ($_GET['do']=='deleteAnn') { 
	$id = $_GET['id']; 
	$sql = "delete from tbl_announcements where id = '$id'";
	(mysqli_query($conn, $sql));
	$message = "Announcements Successfully Deleted.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='announcements.php';</script>";
	exit();

} 

//Other Dashboard 
if ($_GET['do']=='changeVehicleStat') {
	$id = $_GET['id'];
	$fee = 0;
	$sql = "update tbl_violations set vstatus='Paid', fee='$fee' where id = '$id'";
	(mysqli_query($conn, $sql));
	$message = "Violation Successfully Updated.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='dashboard.php';</script>";
	exit(); 
}  

if ($_GET['do']=='deleteViolation') { 
	$id = $_GET['id']; 
	$sql = "delete from tbl_violations where id = '$id'";
	(mysqli_query($conn, $sql));
	$message = "Violation Successfully Deleted.";
	echo "<script type='text/javascript'>alert('$message');window.location.href='dashboard.php';</script>";
	exit();

} 
?>