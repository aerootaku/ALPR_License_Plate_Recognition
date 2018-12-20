<?php
require('admin-header.php');
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

//first quuery
    $sql = "SELECT * from tbl_admin_accounts where id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            $id = $row['id'];
            $username = $row['username'];
            $password = $row['password'];
            $name = $row['name'];



        }

    }
}
?>
			<div class="row">
				<form class='form-horizontal' id='validation-form' role='form' action='models.php?do=addUserAdmin' method='POST'>
				<div class="row">
				<h3>&nbsp;&nbsp;Create New Users</h3>
				<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Name </label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" id="name" placeholder="Name" name="name" class="col-xs-12 col-sm-6" pattern="[a-zA-Z]+" tittle="Letters only" required />
							</div>
						</div>
				</div>
				<div class="space-2"></div>
				<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Username </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="username" placeholder="Username" name="username" class="col-xs-10 col-sm-5" />
							</div>
						</div>
				</div>
				<div class="space-2"></div>
				<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Password </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input name="password" type="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" placeholder="Password" autocomplete="new-password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" />
							</div>
						</div>
				</div>
				<div class="space-2"></div>
				<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Type </label>
						<div class="col-sm-9">
							<select name="type" required>
								<option value="?">--Specify User Type--</option>
								<option value="Employee">Employee</option>
								<option value="Admin">Admin</option>
							</select>
						</div>
				</div>

				<center><button type="submit" class="btn btn-info" name="save" value="submit" formaction="models.php?do=addUserAdmin" />Submit</button></center>
				</form>
				</div>

				</div>
				<hr />


<hr>
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

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/wizard.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/jquery-additional-methods.min.js"></script>
		<script src="assets/js/bootbox.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/select2.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {		
			
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						email: {
							required: true,
							email:true
						},
						password: {
							required: true
						},
						name: {
							required: true,
							name: 'required'
						},
						phone: {
							required: true,
							phone: 'required'
						},
						mobile:{
							required: true,
							phone: 'required'
						},
						url: {
							required: true,
							url: true
						},
						comment: {
							required: true
						},
						state: {
							required: true
						},
						platform: {
							required: true
						},
						subscription: {
							required: true
						},
						gender: {
							required: true,
						},
						agree: {
							required: true,
						},
						username: {
							required: true,
							username: 'required'
						}
					},
			
					messages: {
						email: {
							required: "Please provide a valid email.",
							email: "Please provide a valid email."
						},
						name: {
							required: "Input only letters",
							name: "Input only letters"
						},
						password: {
							required: "Please specify a password.",
							minlength: "Please specify a secure password."
						},
						state: "Please choose state",
						subscription: "Please choose at least one option",
						gender: "Please choose gender",
						agree: "Please accept our policy"
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					invalidHandler: function (form) {
					}
				});
			
				
				
				
				$('#modal-wizard-container').ace_wizard();
				$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
				
				
				/**
				$('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				
				$('#mychosen').chosen().on('change', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				*/
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
			})
		</script>
	</body>
</html>
