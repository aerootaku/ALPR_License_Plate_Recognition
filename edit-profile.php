<?php 
session_start();
// include('controller/sessionl.php');

require 'header.php';

$username=$_SESSION['username']; 
$query = mysql_query("select * from tbl_users_info where username ='$username'")or die(mysql_error());

while($row=mysql_fetch_array($query))
{ 
	$id=$row['id'];

	?>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="clearfix">
			</div>

			<div class="hr dotted"></div>
			<form action="edit-profile-submit.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
				<div>
					<div id="user-profile-1" class="user-profile row">
						<div class="col-xs-12 col-sm-3 center">
							<div>
								<span class="profile-picture">
									<img class="editable img-responsive" alt="Profile Picture" src="admin/<?php echo $row['profile'];; ?>" />
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

									<a href="pw-updatepassword.php?id=<?php echo $_SESSION['id'] ?>" class="btn btn-link">
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
													<div class="profile-info-name"> Full Name </div>
													&nbsp;&nbsp;&nbsp;<input pattern="[a-zA-Z]+" title ="Only enter letters" type="text" name="surname" value="<?php echo $row['lastname']; ?>" readonly>
													,
													<input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" pattern="[a-zA-Z]+" title ="Only enter letters" readonly>
													<input type="text" name="middlename" pattern="[a-zA-Z]+" title ="Only enter letters" value="<?php echo $row['middlename']; ?>" readonly>
													<div class="profile-info-value">
														
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Address </div>

													<div class="profile-info-value">
														<textarea placeholder="Address" class="col-xs-10 col-sm-5" name="address" readonly><?php echo $row['address']; ?></textarea>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Age </div>

													<div class="profile-info-value">
														<input type="number" name="age" value="<?php echo $row['age']; ?>" readonly>

													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email Address </div>

													<div class="profile-info-value">
														<input type="email" name="email" value="<?php echo $row['email']; ?>" readonly>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Contact</div>

													<div class="profile-info-value">
														<input type="text" id="form-field-1" class="input-mask-phone col-xs-10 col-sm-5" id="form-field-mask-2" name="phone" value="<?php echo $row['contact']; ?>" readonly/>
													</div>
												</div>


											</div>
											<br /><br />
											<div class="clearfix"></div>
											<center>
											</form>
											<?php 
										}
										?>
										<div class="space-20"></div>
										<?php 
										$query = mysql_query("select * from tbl_users_info where id ='$xid'")or die(mysql_error());

										while($row=mysql_fetch_array($query))
										{ 


											?>



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
												</div>
												<?php 
											}
											?>
											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											
										</div>
									</div>
								</div>

								
								<?php 
							}
							?>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
		<?php 

		require('footer.php');
		?>
