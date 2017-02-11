<div class="row">
	<div class="col-md-12">
		<div class="col-md-10 col-md-offset-1"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-10 col-md-offset-1" style="margin-top: 30px;">
	<?php echo form_open(site_url("setting/set"), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="set[store_name]" class="col-sm-2 control-label">Application Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="set[store_name]" value="<?php echo $this->app->get('store_name'); ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="set[app_owner]" class="col-sm-2 control-label">Bussines Owner</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="set[app_owner]" value="<?php echo $this->app->get('app_owner'); ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="set[phone_number]" class="col-sm-2 control-label">Phone Number</label>
		    	<div class="col-sm-6">
		      		<input type="text" class="form-control" name="set[phone_number]" value="<?php echo $this->app->get('phone_number'); ?>">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="set[address]" class="col-sm-2 control-label">Address</label>
		    	<div class="col-sm-10">
		      		<textarea name="set[address]" class="form-control" rows="3"><?php echo $this->app->get('address'); ?></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="set[ppn_tax]" class="col-sm-2 control-label">PPN Tax Value</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" name="set[ppn_tax]" value="<?php echo $this->app->get('ppn_tax'); ?>" required="" placeholder="EX : 10">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="set[table_count]" class="col-sm-2 control-label">Table Count</label>
		    	<div class="col-sm-2">
		      		<input type="text" class="form-control" name="set[table_count]" value="<?php echo $this->app->get('table_count'); ?>" required="" placeholder="EX : 10">
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<button type="reset" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</button>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>