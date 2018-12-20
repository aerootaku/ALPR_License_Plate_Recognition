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