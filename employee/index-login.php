<?php
include '../controller/conn.php';
session_start();

if(isset($_SESSION['userID'])){

	header('location:index.php');
}

$user = $_POST['username'];
$pass =  md5($_POST['password']);

$sql = "SELECT * FROM tbl_users where username = '$user' and password = '$pass'";
$result = $conn->query($sql);

if($result-> num_rows > 0){
	while($row= $result->fetch_assoc()){
		// $_SESSION['LID'] = $row['esig']; //pass the esig to session
		$_SESSION['id']=	$row['id']; // pass the id to session
		$_SESSION['userID'] = $row['name']; // pass the name to userID session
		$_SESSION['username'] = $row['username']; // pass the username to session username
		$type=$row['type'];
		
	}

	// Check the department of username and password
		if($type=='Employee')
		{
		echo"<script>alert('Successfully Login')</script>";
		echo"<script>window.location='dashboard.php'</script>";
		}
		else{
			echo"<script>alert('User is not an Employee')</script>";
			echo"<script>history.go(-1);</script>";
		}



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

