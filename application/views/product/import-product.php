<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-6 col-md-offset-3" style="margin-top: 30px;">
	<?php echo form_open_multipart(site_url('product/set_import'), array('class' => 'form-horiontal')); ?>
			<div class="form-group col-md-12" style="background-color: #F0F0F0; padding: 20px;">
				<h5><i class="fa fa-info-circle"></i> Requirement</h5>
				<p>- Must file extension .xlsx (Microsoft Excel 2017/2010)</p>
				<p>- Download data frame <a href="">[HERE]</a></p>
			</div>
		  	<div class="form-group col-md-12" style="margin-top: 20px;">
		    	<label for="file_excel" class="col-sm-3 control-label">Excel File</label>
		    	<div class="col-sm-8">
		      		<input type="file" class="form-control" name="file_excel" >
		      		<?php echo form_error('code', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
			<div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-upload bigger-110"></i>Upload Data
						</button>
						<a href="<?php echo site_url('product') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			</div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>