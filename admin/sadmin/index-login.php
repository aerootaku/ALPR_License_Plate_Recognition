<?php

include '../controller/connect.php'; 
session_start();
date_default_timezone_set('Asia/Manila');
	$dt =  date('Y-m-d h:i:s'); 

if(isset($_SESSION['userID'])){

	header('location:dashboard.php');
}

$user = $_POST['username'];
$pass =  md5($_POST['password']);

$sql = "SELECT * FROM tbl_users where type='Admin' AND username = '$user' and password = '$pass'";
$result = $conn->query($sql);

if($result->num_rows > 0){
	while($row= $result->fetch_assoc()){
		// $_SESSION['LID'] = $row['esig']; //pass the esig to session
		$_SESSION['id']=	$row['id']; // pass the id to session
		$_SESSION['userID'] = $row['name']; // pass the name to userID session
		$_SESSION['username'] = $row['username']; // pass the username to session username
		$type=$row['type'];
		$user_adminID=$row['id'];
	}
$user_adminID=$_SESSION['id'];
$action="Logged-in.";
$sql=("INSERT INTO tbl_logs(user_adminID, dt, action) VALUES ('$user_adminID','$dt','$action')"); 
    	(mysqli_query($conn, $sql)); 
	// Check the department of username and password
		// if($type=='admin')
		// {
		// echo"<script>alert('Successfully Login')</script>";
		// echo"<script>window.location='dashboard.php'</script>";
		// }
		// if($type=='Employee')
		// {
		// echo"<script>alert('Successfully Login')</script>";
		// echo"<script>window.location='../employee/dashboard.php'</script>";
		// }
echo"<script>alert('Successfully Login')</script>";
		echo"<script>window.location='dashboard.php'</script>";
}
		
else
{
	?>
	<!--check if the username and password is correct-->
	<script> alert('Invalid username or password'); </script>
	<script>window.location='index.php';</script>
	<?php
}
//close the mysql connection
$conn->close();


//clean build Aug 30, 2016
?>

