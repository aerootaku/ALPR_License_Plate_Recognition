	<?php
include 'controller/conn.php';
session_start();
if(isset($_SESSION['userID'])){

	header('location:index.php');
}


if (isset($_GET['do'])) if ($_GET['do']=='goLogin') {
	$distime=$_SESSION['distime'];
	if ( $_SESSION['attemp']=='0') { 
		$message = "You can now login."; 
	} else {
		$message = "Wait until for a while."; 
	}
	echo "<script type='text/javascript'>alert('$message');window.location.href='index.php';</script>";
	exit();
}


$user = $_POST['username'];
$pass =  md5($_POST['password']);

//$sql="SELECT * FROM tbl_users_info WHERE username = '$user'";

$sql = "SELECT *,ui.id as id , ui.id as userID,u.id as uid FROM tbl_users u INNER JOIN tbl_users_info ui ON u.username=ui.username where u.username = '$user'";
$result = $conn->query($sql); 
if($row= $result->fetch_assoc()){ 

	$_SESSION['id']=$row['id'];
	$_SESSION['userID']=$row['userID'];
	$_SESSION['uID']=$row['uid'];
	$uID=$_SESSION['uID'];
	$_SESSION['attemp']=$row['logattempt']; 
	$id=$row['id'];
	$_SESSION['type'] = $row['type']; 
	// if ($row['type']=="admin"){
	// 	echo"<script>alert('Login to admin side.')</script>";
	// 	echo "<script>window.location='index.php'</script>";
	// 	exit();
	// }

	if ($row['logattempt']=='5') { 
		echo"<script>alert('Unabled to login.\\nPLEASE CONTACT YOUR ADMINISTRATOR TO REACTIVATE YOUR ACCOUNT!')</script>";
		echo "<script>window.location='index.php?'</script>";
		exit();
	}
	elseif($pass==($row['password'])) { 
		
		$_SESSION['username'] = $row['username']; // pass the username to session username
		// $sql="UPDATE  tbl_users SET logattempt='0' WHERE id='$id'";
		// mysqli_query($conn,$sql);  
		$_SESSION['type'] = $row['type']; 
		$uname = $_SESSION['username']; 
		echo"<script>alert('Welcome $uname')</script>";
		 if ($row['type']=='employee'){
			echo "<script>window.location='employee/dashboard.php'</script>"; 
		} elseif ($row['type']=='admin'){
			echo "<script>window.location='admin/dashboard.php'</script>"; 
		}else {
			echo "<script>window.location='dashboard.php'</script>";
		}
		
		
		
	} else {
		$_SESSION['attemp']=$_SESSION['attemp']+1;
		$stat= $_SESSION['attemp'];
		$id=$row['id'];
		$sql="UPDATE  tbl_users SET logattempt='$stat' WHERE id='$uID'";
		mysqli_query($conn,$sql);

		
		if ($_SESSION['attemp']=='5') { 
			$_SESSION['attemp']=0;
			echo"<script>alert('Unabled to login.\\nPLEASE CONTACT YOUR ADMINISTRATOR TO REACTIVATE YOUR ACCOUNT!')</script>";
			echo "<script>window.location='logout.php'</script>";
			exit();
		} else { 

			?> 
			<script> alert('Invalid username or password. attempt : <?php echo$stat;?>'); </script> 
			<script>window.location='logout.php';</script>

			<?php } }
		}  else { ?>
		<script> alert('Invalid user not exist'); </script>
		<script>window.location='logout.php';</script>
		<!--check if the username and password is correct-->
		
		<?php }
//close the mysql connection
		$conn->close();
//clean build Aug 30, 2016
		?>

