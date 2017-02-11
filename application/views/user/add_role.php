<div class="row">
	<div class="col-md-12">
		<div class="col-md-10 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		<div class="col-md-10 col-md-offset-1">
	<?php echo form_open(site_url("user/insertrole"), array('class' => 'form-horiontal')); ?>
		  	<div class="form-group col-md-12">
		    	<label for="name" class="col-sm-2 control-label">Name</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="name" value="" required="">
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label class="col-sm-2 control-label">Description</label>
		    	<div class="col-sm-10">
		      		<textarea name="description" class="form-control" rows="3"></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group col-md-12">
		    	<label class="col-sm-2 control-label">Privileges</label>
		    	<div class="col-md-12">
		    		<span class="space-4"></span>
		    		<table class="table table-bordered">
		    			<thead>
		    				<tr>
		    					<th colspan="2" class="text-center">Module Name</th>
		    					<th rowspan="2" width="100" class="text-center">Lock Module</th>
		    					<th colspan="4" class="text-center">Actions</th>
		    				</tr>
		    				<tr>
		    					<th class="text-center">Menu</th>
		    					<th class="text-center">Sub Menu</th>
		    					<th width="100" class="text-center">Create</th>
		    					<th width="100" class="text-center">Read</th>
		    					<th width="100" class="text-center">Update</th>
		    					<th width="100" class="text-center">Delete</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    			<?php echo form_hidden('role[dashboard]', 'dashboard');?>
		    				<tr>
		    					<td rowspan="3" class="text-center">Dashboard <i class="ace-icon fa fa-angle-double-right"></i> <small>Overview & Stats</small></td>
		    					<td class="text-center">-</td>
		    					<td class="text-center">
									<label>
										<input name="role[dashboard][]" class="ace ace-switch" type="checkbox" /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">

		    					</td>
		    					<td class="text-center">

		    					</td>
		    					<td class="text-center"></td>
		    					<td class="text-center"></td>
		    				</tr>
		    			<?php echo form_hidden('role[entry_order]', 'entry_order'); echo form_hidden('role[entry_order][]', 'on'); ?>
		    				<tr>
		    					<td rowspan="3" class="text-center">Dashboard <i class="ace-icon fa fa-angle-double-right"></i> <small>Overview & Stats</small></td>
		    					<td class="text-center">-</td>
		    					<td class="text-center">
									<label>
										<input name="role[entry_order][]" class="ace ace-switch" type="checkbox" value="read" <?php if(in_array('read', $this->user->getRole($get->role, 'entry_order'))) echo "checked"; ?> /><span class="lbl"></span>
									</label>
		    					</td>
		    					<td class="text-center">

		    					</td>
		    					<td class="text-center">

		    					</td>
		    					<td class="text-center"></td>
		    					<td class="text-center"></td>
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		  	</div>			
			  <div class="col-md-12">
				<div class="clearfix form-actions">
					<div class="col-md-offset-4 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>Save
						</button>
						<a href="<?php echo site_url('user/role') ?>" class="btn" type="reset" style="margin-left: 100px;">
							<i class="ace-icon fa fa-undo bigger-110"></i> Back
						</a>
					</div>
				</div>
			  </div>
	<?php echo form_close(); ?>
		</div>
	</div>

</div>