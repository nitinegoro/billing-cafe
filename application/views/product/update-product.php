<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-10 col-md-offset-1" style="margin-top: 30px;">
	<?php echo form_open_multipart(current_url(), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="code" class="col-sm-3 control-label">Product Code</label>
		    	<div class="col-sm-4">
		    		<input type="hidden" class="form-control" name="item_ID" value="<?php echo $get->item_ID; ?>">
		      		<input type="text" class="form-control" name="code" value="<?php echo $get->code; ?>">
		      		<?php echo form_error('code', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-3 control-label">Product Name (<small><i>Required</i></small>)</label>
		    	<div class="col-sm-9">
		      		<input type="text" class="form-control" name="name" value="<?php echo $get->product_name; ?>">
		      		<?php echo form_error('name', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="category" class="col-sm-3 control-label">Category (<small><i>Required</i></small>)</label>
		    	<div class="col-sm-5">
		      		<select name="category" class="form-control">
		      			<option value="">-- Select One --</option>
		      		<?php  
		      		/**
		      		 * Loop Category Sales
		      		 *
		      		 **/
		      		foreach($this->product->category() as $row) :
		      		?>
						<option value="<?php echo $row->ps_ID; ?>" <?php if($get->ps_ID==$row->ps_ID) echo "selected"; ?>><?php echo $row->product_sales; ?></option>
		      		<?php  
		      		endforeach;
		      		?>
		      		</select>
		      		<?php echo form_error('category', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="description" class="col-sm-3 control-label">Description</label>
		    	<div class="col-sm-9">
		      		<textarea name="description" class="form-control" id="" cols="3" rows="4"><?php echo $get->description_product; ?></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="price" class="col-sm-3 control-label">Price (<small><i>Required</i></small>)</label>
		    	<div class="col-sm-4">
		      		<input type="text" class="form-control" name="price" value="<?php echo $get->price; ?>">
		      		<?php echo form_error('price', '<small class="text-red">', '</small>'); ?>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label for="status" class="col-sm-3 control-label">Product Status (<small><i>Required</i></small>)</label>
		    	<div class="col-sm-4">
					<div class="radio-inline">
						<label>
							<input name="status" class="ace ace-radio-2" type="radio" value="available" <?php if($get->status=='available') echo "checked"; ?>/>
							<span class="lbl"> Available</span>
						</label>
					</div>
					<div class="radio-inline">
						<label>
							<input name="status" class="ace ace-radio-2" type="radio" value="unavailable" <?php if($get->status=='unavailable') echo "checked"; ?>/>
							<span class="lbl"> Unavailable</span>
						</label>
					</div>
		    	</div>
		    	<div class="col-sm-4 col-md-offset-3">
					<?php echo form_error('status', '<small class="text-red">', '</small>'); ?>
		    	</div>
		    	
		  	</div>
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
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