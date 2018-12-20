<?php
include '../controller/conn.php';
include '../controller/session.php';	
include('../controller/dbcon.php');
?>
 	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Serial Plates | Home</title>

	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
			<![endif]-->
			<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
			<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		  <![endif]-->

		  <!-- inline styles related to this page -->

		  <!-- ace settings handler -->
		  <script src="assets/js/ace-extra.min.js"></script>

		  <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="dashboard.php" class="navbar-brand">
						<small>
							<img src="assets/images/serial.png" height="25px" width="25px" />
							Serial Plates
						</small>
					</a>

				</div>



				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					 
						<li class="dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<!-- <i class="ace-icon fa fa-icon-calendar"></i> -->
								<span class="badge badge-important">
								<script type="text/javascript">
tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>
<div id="clockbox"></div></span>
								</a> 
						</li>  


						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important"><?php

									$result = mysql_query("SELECT * FROM tbl_violations WHERE vstatus='Pending' ");
									$num_rows = mysql_num_rows($result);

									echo $num_rows; ?></span>
								</a>
  

								<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
									<li class="dropdown-header">
										<i class="ace-icon fa fa-exclamation-triangle"></i>
										New Violations
									</li>

									<li class="dropdown-content">
										<ul class="dropdown-menu dropdown-navbar navbar-pink">

											<li>
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												<?php
												$sqlnotif = "SELECT * from tbl_violations where vstatus='Pending' || vstatus='pending' ORDER by id DESC limit 5";
												$result = $conn->query($sqlnotif);

												if ($result->num_rows > 0) {

													while ($row = $result->fetch_assoc()) {

														$id = $row['id'];
														$name=$row['name'];
														$platenumber = $row['xplatenum'];
														$date=$row['date'];



													}
echo $name. "-" .$platenumber;
												} else { 
												 echo "No Violations.";} 
													?>




												</li>
											</ul>
										</li>

								<!-- <li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li> -->
							</ul>
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $_SESSION['userID']?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="pw-updatepassword.php?id=<?php echo $_SESSION['id'] ?>">
										<i class="ace-icon fa fa-key"></i>
										Password Update
									</a>
								</li>

								<!-- <li>
									<a href="profile.php">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li> -->

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				

				<ul class="nav nav-list">
					
					<li class="active">
						<a href="dashboard.php">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text">Dashboard </span>
						</a>
					</li>

					<!-- File Maintenance -->

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file"></i>

							<span class="menu-text">
								File Maintenance
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="add-new.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Vehicle Owners
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="user-list.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Vehicle Owners List
								</a>

								<b class="arrow"></b>
							</li>

						 
						</ul>

						<ul class="submenu">
							<li class="">
								<a href="speed-fine-new.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Speed Fine
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="speed-fine-list.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Speed Fine List
								</a>

								<b class="arrow"></b>
							</li>

						 
						</ul>
					</li>
					<!-- /File Maintenance -->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog"></i>

							<span class="menu-text">
								Tools
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="announcements.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Announcements
								</a>

								<b class="arrow"></b>
							</li>
								<li class="">
									<a href="new-announcement.php">
										<i class="menu-icon fa fa-caret-right"></i>
								New	Announcements
									</a>

									<b class="arrow"></b>
								</li>
							</ul>
						</li>
					</ul><!-- /.nav-list -->

				</div>

				<div class="main-content">
					<div class="main-content-inner">
						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li class="active">
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="#">Home</a>
								</li>
							</ul><!-- /.breadcrumb -->
						</div>

						<div class="page-content">
							<div class="ace-settings-container" id="ace-settings-container">
								<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
									<i class="ace-icon fa fa-cog bigger-130"></i>
								</div>

								<div class="ace-settings-box clearfix" id="ace-settings-box">
									<div class="pull-left width-50">
										<div class="ace-settings-item">
											<div class="pull-left">
												<select id="skin-colorpicker" class="hide">
													<option data-skin="no-skin" value="#438EB9">#438EB9</option>
													<option data-skin="skin-1" value="#222A2D">#222A2D</option>
													<option data-skin="skin-2" value="#C6487E">#C6487E</option>
													<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
												</select>
											</div>
											<span>&nbsp; Choose Skin</span>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
											<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
											<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
											<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
											<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
											<label class="lbl" for="ace-settings-add-container">
												Inside
												<b>.container</b>
											</label>
										</div>
									</div><!-- /.pull-left -->

									<div class="pull-left width-50">
										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
											<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
											<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
										</div>

										<div class="ace-settings-item">
											<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
											<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
										</div>
									</div><!-- /.pull-left -->
								</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->