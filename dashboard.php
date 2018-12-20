<?php 
session_start();
include('controller/connect.php');

require 'header.php';
?>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="clearfix">
		</div>
		<div class="alert alert-block alert-success">
			<button type="button" class="close" data-dismiss="alert">
				<i class="ace-icon fa fa-times"></i>
			</button>
			<h3>Announcements</h3>
			<?php 
			$query1 = mysql_query("select * from tbl_announcements LIMIT 3")or die(mysql_error());

			while($row=mysql_fetch_array($query1))
			{ 
				$id=$row['id'];

				?>
				<p><?php echo $row['announcements']; ?></p>
				<?php }?>

			</div>
			<div class="hr dotted"></div>
			<?php $username=$_SESSION['username'];  
			$query = mysql_query("select * from tbl_users_info where username ='$username'")or die(mysql_error());

			while($row=mysql_fetch_array($query))
			{ 
				$id=$row['id'];

				?>

				<div>
					<div id="user-profile-1" class="user-profile row">
						<div class="col-xs-12 col-sm-3 center">
							<div>
								<span class="profile-picture">
									<img class="editable img-responsive" alt="Profile Picture" src="admin/<?php echo $row['profile']; ?>" />
								</span>

								<div class="space-4"></div>

								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
									<div class="inline position-relative">

										<i class="ace-icon fa fa-circle light-green"></i>
										&nbsp;
										<span class="white">Last Login <?php echo date('Y-M-D'); ?></span>
									</div>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="profile-contact-info">
								<div class="profile-contact-links align-left">
									<a href="edit-profile.php" class="btn btn-link">
										<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
										View my profile
									</a>

									<a href="pw-updatepassword.php?id=<?php echo $xid ?>" class="btn btn-link">
										<i class="ace-icon fa fa-cog bigger-120 pink"></i>
										Change Password
									</a>
								</div>

								<div class="space-6"></div>
							</div>

							<div class="hr hr12 dotted"></div>

							<div class="clearfix">
												<!-- <div class="grid2">
													<span class="bigger-175 blue">25</span>

													<br />
													Inbox
												</div> -->
												

											</div>

											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">


											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Fullname	 </div>
													&nbsp;&nbsp;&nbsp;<?php

													echo $row['lastname']. ", ".$row['firstname']; ?>

													<div class="profile-info-value">
														
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Address </div>

													<div class="profile-info-value">
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<?php

														echo $row['address']; ?>

													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Age </div>

													<div class="profile-info-value">
														<?php

														echo $row['age']; ?>

													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email Address </div>

													<div class="profile-info-value">
														<?php

														echo $row['email']; ?>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Contact</div>

													<div class="profile-info-value">
														<?php

														echo $row['contact']; ?>
													</div>
												</div>


											</div>
											<?php 
										}
										?>
										<div class="space-20"></div>


	<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-bordered table-striped">
					<thead class="thin-border-bottom">
						<tr>
							<th> Plate Number </th> 
							<th> Color </th>
							<th> MV File
							</th>
							<th> Chassis </th>
							<th> Engine Num
							</th>
							<th> Year Model
							</th>
							<th> Body Type </th>
							<th> Make </th>
							<th> OR Number
							</th>
							<th> CR Number
							</th>
							
							
						</tr>
					</thead>

					<tbody>
						<?php 
						$uiid=$_SESSION['userID']; 
						$sqlcar=mysql_query("select * from tbl_cars WHERE users_infoID='$uiid' ");
						while($row=mysql_fetch_array($sqlcar)) { $id=$row['id']; 
						?>
						<tr>
							<td><?php echo $row['platenumber']; ?></td> 
							<td><?php echo $row['color']; ?></td>  
							<td><?php echo $row['mv_file']; ?></td>
							<td><?php echo $row['chassis']; ?></td>
							<td><?php echo $row['engine_num']; ?></td>
							<td><?php echo $row['year_model']; ?></td>
							<td><?php echo $row['mv_type']; ?></td>
							<td><?php echo $row['make']; ?></td>
							<td><?php echo $row['or_no']; ?></td>
							<td><?php echo $row['cr_no']; ?></td>
							
					</tr>
				</tbody>
				<?php
			}
			?>
		</table>
	</div><!-- /.widget-main -->
</div><!-- /.widget-body -->

										<div class="widget-box transparent">
											<div class="widget-header widget-header-small">
												<h4 class="widget-title blue smaller">
													<i class="ace-icon fa fa-rss orange"></i>
													Violations Tracker
												</h4>

												<div class="widget-toolbar action-buttons">
													<a href="#" data-action="reload">
														<i class="ace-icon fa fa-refresh blue"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
													<div id="profile-feed-1" class="profile-feed">
														<?php	
														$users_infoID=$_SESSION['id'];
														$queryx = mysql_query("select * from tbl_violations where users_infoID ='$users_infoID'")or die(mysql_error());

														while($row=mysql_fetch_array($queryx))
														{ 
															$xplate=$row['xplatenum'];
															$xname = $row['name'];

															?>
															<div class="profile-activity clearfix">
																<div>
																	<a class="user" href="#"> 
																	</a>
																	<?php echo "Plate number: ".$row['xplatenum']."<br /> Speed Detected: ".$row['spd_detected'];
																	?> 									
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		<?php echo $row['date']. " ". $row['time']; ?>
																	</div>
																	<div>Fee : 

<?php if($row['spd_detected'] >= 100 and $row['spd_detected'] <=349 ){
echo "₱". $fee='300'; 
}elseif($row['spd_detected'] >= 350 and $row['spd_detected'] <=400 ){
echo "₱". $fee='700';
} elseif($row['spd_detected'] >= 401 and $row['spd_detected'] <=10000 ){
echo "₱". $fee='1000'; 
}  ?>
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												
											<?php 
										}
										?>
											</div>
										<div class="hr hr2 hr-double"></div>

										<div class="space-6"></div>


									</div>
								</div>
							</div>



							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->


		<?php 

		require('footer.php');
		?>
