<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
	<?php echo form_open_multipart(current_url(), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-3 control-label">Category Name (<small><i>Required</i></small>)</label>
		    	<div class="col-sm-9">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->product_sales; ?>">
		      		<?php echo form_error('name', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="description" class="col-sm-3 control-label">Description</label>
		    	<div class="col-sm-9">
		      		<textarea name="description" class="form-control" id="" cols="3" rows="4"><?php echo $get->description_sales;; ?></textarea>
		    	</div>
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('sell_category') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>