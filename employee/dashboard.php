<?php
require('admin-header.php');
?>

<div class="page-header">
	<h1>
		Dashboard
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-sm-6">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title lighter">
					<i class="ace-icon fa fa-star orange"></i>
					Recent Violations
				</h4>

				<div class="widget-toolbar">
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th>
									Name
								</th>

								<th>
									Plate Number
								</th>

								<th>
									Date & Time Violated
								</th>


							</tr>
						</thead>

						<tbody>
							<?php 

							$violations_query=mysql_query("select * from tbl_violations LIMIT 5")or die(mysql_error());
							while($row=mysql_fetch_array($violations_query)){ $id=$row['id'];

							?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td>

									<?php echo $row['xplatenum']; ?>
								</td>

								<td>
									<?php echo $row['date']." ".$row['time']	; ?>
								</td>
							</tr>
						</tbody>
						<?php
					}
					?>
				</table>
			</div><!-- /.widget-main -->
		</div><!-- /.widget-body -->
	</div><!-- /.widget-box -->
</div><!-- /.col -->		


<div class="col-sm-6">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-flat">
			<h4 class="widget-title lighter">
				<i class="ace-icon fa fa-star orange"></i>
				Need Attention
			</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-bordered table-striped">
					<thead class="thin-border-bottom">
						<tr>
							<th> Name </th> 
							<th> Address </th> 
							<th> Phone </th> 
							<th> Email Address </th> 
						</tr>
					</thead>

					<tbody>
						<?php 

						$violations_query=mysql_query("select *,COUNT(*)tt from tbl_violations GROUP BY users_infoID")or die(mysql_error());
						while($row=mysql_fetch_array($violations_query)){ $tt=$row['tt']; $users_infoID=$row['users_infoID'];
						if ($tt>=3){ 

							$sql=mysql_query("select  * from tbl_users_info  WHERE id='$users_infoID'")or die(mysql_error());
							if($rows=mysql_fetch_array($sql)){	?>

							<tr>
								<td><?php echo $rows['lastname'].','.$rows['firstname']; ?></td> 
								<td><?php echo $rows['address']; ?></td> 
								<td><?php echo $rows['contact']; ?></td> 
								<td><?php echo $rows['email']; ?></td>  
							</tr>


							<?php } }} ?>
						</tbody>
					</table>
				</div><!-- /.widget-main -->
			</div><!-- /.widget-body -->
		</div><!-- /.widget-box -->
	</div><!-- /.col -->								
</div>


<br />
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div class="row">
			<div class="col-xs-12">

				<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>
				<div class="table-header">
					Violation Records
				</div>

				<!-- div.table-responsive -->

				<!-- div.dataTables_borderWrap -->
				<div>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
												<!-- 		<th class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th>Name</th>
														<th>Speed </th>
														<th>Plate Number</th>

														<th>	
															Date Violated
														</th>
														<th>Fee</th>
														<th>Status</th>

														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													$v_query=mysql_query("SELECT * from tbl_violations WHERE  users_infoID ='0'")or die(mysql_error());
													while($row=mysql_fetch_array($v_query)){ 
														$plateno=$row['xplatenum'];
														$sql=mysql_query("SELECT *,CONCAT(firstname,' ',middlename,' ',lastname)fullname from tbl_cars c INNER JOIN tbl_users_info ui ON c.users_infoID=ui.id  WHERE c.platenumber='$plateno'")or die(mysql_error());
														if($ro=mysql_fetch_array($sql)){
															$userID=$ro['users_infoID'];
															$fullname=$ro['fullname'];

															$sql=mysql_query("UPDATE tbl_violations SET users_infoID='$userID' ,name='$fullname' WHERE xplatenum='$plateno'");
															(mysql_fetch_array($sql));
														}
													}

													$v_query=mysql_query("SELECT * from tbl_violations")or die(mysql_error());
													while($row=mysql_fetch_array($v_query)){ $id=$row['id'];

													?>
													<tr>
														<!-- <td class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</td> -->

														<td><?php if($row['name']=='')
														{
															echo "No Records";
														}
														else{

															echo $row['name'];

														} ?> </td>
														<td><?php if($row['spd_detected'] == '')
														{
															echo "No Speed Recorded";
														}
														else{
															
															if($row['spd_detected'] >= 0 and $row['spd_detected'] <=100 ){
																echo "90Kmph"; 
															}elseif($row['spd_detected'] >= 101 and $row['spd_detected'] <=200 ){ 
																echo "100Kmph"; 
															} elseif($row['spd_detected'] >= 201 and $row['spd_detected'] <=300 ){
																echo "120Kmph"; 
															}  elseif($row['spd_detected'] >= 301 and $row['spd_detected'] <=100000 ){
																echo "160Kmph"; 
															} 


														}?>

													</td>
													<td>
														<?php 
														if($row['xplatenum']==''){
															echo "Plate Number Unknown";
														} 
														else{
															echo $row['xplatenum'];
														} 
														?>

													</td>
													<td><?php echo $row['date']." ".$row['time']; ?></td>
													<td><?php


													if($row['spd_detected'] >= 0 and $row['spd_detected'] <=100 ){
														echo "₱". $fee='150'; 
													}elseif($row['spd_detected'] >= 101 and $row['spd_detected'] <=200 ){
														echo "₱". $fee='200';
													} elseif($row['spd_detected'] >= 201 and $row['spd_detected'] <=300 ){
														echo "₱". $fee='500'; 
													}  elseif($row['spd_detected'] >= 301 and $row['spd_detected'] <=100000 ){
														echo "₱". $fee='1000'; 
													} 
													$id=$row['id']; 
													$sql=("UPDATE tbl_violations SET fee='$fee' WHERE fee='0' AND  id='$id'");
													(mysqli_query($conn, $sql)); 





													?></td>
													<td class="hidden-480">
														<?php echo $row['vstatus']; ?>
													</td>

													<td>
														<div class="hidden-sm hidden-xs action-buttons">
															<a class="green" href="models.php?do=changeVehicleStat&id=<?php echo $id; ?>" onClick="return confirm('This user is paid?')">
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>

															<a class="red" href="models.php?do=deleteViolation&id=<?php echo $id; ?>" onClick="return confirm('Are you sure you want to delete this?')">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a>

															<a class="blue" href="print.php?do=printViolation&id=<?php echo $id; ?>" onClick="return confirm('Are you sure you want to print this?')">
																<i class="ace-icon fa fa-print bigger-130"></i>
															</a>
														</div>
														<?php 
													}?>
													<div class="hidden-md hidden-lg">
														<div class="inline pos-rel">
															<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
															</button>

															<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

																<li>
																	<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																		<span class="green">
																			<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																		</span>
																	</a>
																</li>

																<li>
																	<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																		<span class="red">
																			<i class="ace-icon fa fa-trash-o bigger-120"></i>
																		</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- PAGE CONTENT ENDS -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.page-content -->
		</div>
	</div><!-- /.main-content -->
	<div class="footer">
		<div class="footer-inner">
			<div class="footer-content">
				<span class="bigger-120">
					<span class="blue bolder">Serial Plates</span>
					&copy; 2017
				</span>

				&nbsp; &nbsp;
			</div>
		</div>
	</div>

	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					{ "bSortable": false },
					null, null,null, null, null,
					{ "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50


					select: {
						style: 'multi'
					}
				} );

				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					{
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					},
					{
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					},
					{
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					},
					{
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					},
					{
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					},
					{
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					}		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});

				////

				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );




				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});



				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});

				

				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});



			})
		</script>
	</body>
	</html>
