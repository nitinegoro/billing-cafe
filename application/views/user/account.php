<div class="row">
	<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Login Setting</h4><hr>
			</div>
	<?php echo form_open(current_url(), array('class' => 'form-horiontal')); 
	?>
		  	<div class="form-group col-md-12">
		    	<label for="username" class="col-sm-3 control-label">Username <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		    		<input type="hidden" class="form-control" name="user_ID" value="<?php echo $get->user_ID; ?>">
		      		<input type="text" class="form-control" name="username" value="<?php echo $get->username; ?>">
		      		<?php echo form_error('username', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="password" class="col-sm-3 control-label">New Password</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>">
		      		<?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
		      		<p class="help-block"><i>Enter a new password If you want to change your password.</i></p>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="pass_again" class="col-sm-3 control-label">Repeat Password</label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="pass_again" value="<?php echo set_value('pass_again'); ?>">
		      		<?php echo form_error('pass_again', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="old_pass" class="col-sm-3 control-label">Old Password <strong class="text-danger">*</strong></label>
		    	<div class="col-sm-9">
		      		<input type="password" class="form-control" name="old_pass" value="<?php echo set_value('old_pass'); ?>">
		      		<?php echo form_error('old_pass', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		  		<hr>
		    	<strong class="text-danger">*</strong> : <i>Required field!</i>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back to users
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>