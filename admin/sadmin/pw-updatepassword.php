<?php
require('admin-header.php');
?>

						<div class="page-header">
							<h1>
							Password Update
							</h1>
						</div><!-- /.page-header -->
						
			<div class="row"><?php echo$_SESSION['id'];?>
			
				<form action='admin-pwchange-submit.php?id=<?php echo$_SESSION['id'];?>' method='POST' class='form-horizontal'>
				

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Old Password</label>
						<div class="col-sm-9">
								<input type="password" id="form-field-1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters"  placeholder="Old Password" name="oldpassword" class="col-xs-10 col-sm-5" />
						</div>
					</div>
					
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">New Password</label>
						<div class="col-sm-9">
								<input type="password" id="form-field-1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters"  placeholder="New Password" name="newpassword" class="col-xs-10 col-sm-5" />
						</div>
					</div>		
					
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Re-type Password</label>
						<div class="col-sm-9">
								<input type="password" id="form-field-1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters"  placeholder="Re-type Password" name="repassword" class="col-xs-10 col-sm-5" />
						</div>
					</div>	

					<center><input type="submit" class="btn btn-info" name="submit" value="Update Password" /></center>

				</form>

			</div>


<hr>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php
require('univ-page-footer.php');
			?>