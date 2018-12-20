 <body  onload="window.print()" >
<!-- -->

<style>
						table {
							width:40%;
						} 
						table, th, td {
							border: 1px solid black;
							border-collapse: collapse;
							text-align:  left;
 		/*width: 100%;
 		height: 100%;*/
 	}
 	th, td {
 		padding: 5px; 
 	}
 	table#t01 th {
 		background-color: black;
 		color: white;
 	}  
 </style>

 <table border="1"> 
			 			<?php 

include '../controller/connect.php'; 
$id = $_GET['id'];
	$sql=("SELECT * FROM tbl_violations v INNER JOIN tbl_users_info u ON u.id=v.users_infoID INNER JOIN tbl_cars c ON c.users_infoID=u.id WHERE v.id='$id' ");
	$data=mysqli_query($conn,$sql);   
	if($row=mysqli_fetch_array($data)){ 
?>
				<tr>
					<td>Name</td>
					<td><?php echo$row['name']; ?></td>
				</tr>
						<tr><td>Speed</td> 
					<td><?php echo$row['spd_detected']; ?></td> 	</tr>
						<tr><td>Plate Number</td>
					<td><?php echo$row['xplatenum']; ?></td>	</tr>

						<tr><td>Color</td>
					<td><?php echo$row['color']; ?></td>	</tr>
						<tr><td>Date Violated</td> 
					<td><?php echo$row['date']; ?></td> 	</tr>
						<tr><td>Fee</td>
					<td><?php echo$row['fee']; ?></td>	</tr>
					
						<tr><td>Status</td> 
					<td><?php echo$row['vstatus']; ?>s</td> 	</tr>
			 
<?php } ?>
				<!-- ./HEADER -->
 

				</table>

 </body>