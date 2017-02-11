<div class="row">
	<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				<h4>Add User</h4><hr>
			</div>
	<?php echo form_open(current_url(), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="full_name" class="col-sm-2 control-label">Full Name</label>
		    	<div class="col-sm-10">
		    		<input type="hidden" class="form-control" name="user_ID" value="<?php echo set_value('user_ID'); ?>">
		      		<input type="text" class="form-control" name="full_name" value="<?php echo set_value('full_name'); ?>">
		      		<?php echo form_error('full_name', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="username" class="col-sm-2 control-label">Username</label>
		    	<div class="col-sm-6">
		      		<input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>">
		      		<?php echo form_error('username', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="password" class="col-sm-2 control-label">Password</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>">
		      		<?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="pass_again" class="col-sm-2 control-label">Password again</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="pass_again" value="<?php echo set_value('pass_again'); ?>">
		      		<?php echo form_error('pass_again', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="email" class="col-sm-2 control-label">E-mail</label>
		    	<div class="col-sm-6">
		      		<input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
		      		<?php echo form_error('email', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="phone" class="col-sm-2 control-label">Phone</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" name="phone" value="<?php echo set_value('phone'); ?>">
		      		<?php echo form_error('phone', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="access" class="col-sm-2 control-label">User Privileges</label>
		    	<div class="col-sm-5">
	<?php 
	/**
	 * Role acces data (result_array)
	 *
	 **/
	echo form_dropdown('role', array_column($role_access, 'role_name', 'role_id'), set_value('role'), array('class' => 'form-control'));
	?>
				<?php echo form_error('role', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('user') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>