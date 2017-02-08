<div class="row">
	<div class="col-md-6 col-md-offset-3"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="col-md-7">
			<a href="<?php echo site_url('product/create') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Add New Record
			</a>
			<a href="<?php echo site_url('product/get_print') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-print gray"></i> Print
			</a>
			<a href="<?php echo site_url('product/import') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-upload gray"></i> Import Excel Data
			</a>
			<a href="<?php echo site_url('product/export') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-file-excel-o gray"></i> Export To Excel
			</a>
			<div class="space-4"></div>
		</div>
	</div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<?php echo form_open(current_url(), array('method' => 'get')); ?>
		<div class="col-md-2">
			<label>Show </label>
			<select name="per_page" id="input" class="select-page" onchange="window.location = '<?php echo site_url('product?per_page='); ?>' + this.value + '&query=<?php echo $this->input->get('query'); ?>&category=<?php echo $this->input->get('category') ?>';">
				<option value="10" <?php echo (!$this->input->get('per_page')) ? 'selected' : ''; ?>>10</option>
	<?php  
	$start = 20;
		while($start <= 100) :
	?>
			<option value="<?php echo $start; ?>" <?php echo ($this->input->get('per_page')==$start) ? 'selected' : ''; ?>><?php echo $start; ?></option>
	<?php  
	$start += 10;
	endwhile;
	?>
			</select>
			<label> per page </label>
			<div class="space-4"></div>
		</div>
		<div class="col-md-2">
			<select name="category" id="input" class="select-page col-md-12">
				<option value="">-- Select Category --</option>
		      	<?php	
		      	/**
		      	 * Loop Category Sales
		      	 *
		      	 **/
		      	foreach($this->product->category() as $row) :
		      	?>
					<option value="<?php echo $row->ps_ID; ?>" <?php if($this->input->get('category')==$row->ps_ID) echo "selected"; ?>><?php echo $row->product_sales; ?></option>
		      	<?php  
		      	endforeach;
		      	?>
			</select>
			<div class="space-4"></div>
		</div>
		<div class="col-md-2">
			<select name="status" id="input" class="select-page col-md-12">
				<option value="">-- Product Status --</option>
				<option value="available" <?php if($this->input->get('status')=='available') echo "selected"; ?>>Available</option>
				<option value="unavailable" <?php if($this->input->get('status')=='unavailable') echo "selected"; ?>>Unavailable</option>
			</select>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3">
			<button class="btn btn-white btn-default btn-bold btn-sm btn-round"><i class="fa fa-filter"></i> Filter</button>
			<a href="<?php echo site_url('product') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round"><i class="fa fa-times"></i> Reset</a>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3 pull-right">
			<div class="input-group">
				<input class="form-control input-sm" name="query" type="text" placeholder="Search..." value="<?php echo $this->input->get('query') ?>" />
				<span class="input-group-addon" type="button">
					<i class="ace-icon fa fa-search"></i>
				</span>
			</div>
			<div class="space-4"></div>
		</div>
	<?php 
	echo form_close();
	?>
	</div>
	<div class="col-md-12">
		<?php echo form_open(site_url('master/bulkroom'));  ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th width="120" class="text-center">Code</th>
					<th class="text-center">Product Name</th>
					<th class="text-center">Category</th>
					<th class="text-center" width="300">Description</th>
					<th class="text-center">Price</th>
					<th class="text-center">Status</th>
					<th width="80" class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php  
			/**
			 * Loop Product Item
			 *
			 **/
			foreach($product as $row) :
			?>
				<tr>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="products[]" value="" /> <span class="lbl"></span>
						</label>
					</td>
					<td class="text-center"><?php echo $row->code; ?></td>
					<td><?php echo $row->product_name; ?></td>
					<td><?php echo $row->product_sales; ?></td>
					<td><small><?php echo $row->description_product; ?></small></td>
					<td width="150" class="text-center">Rp. <?php echo number_format($row->price); ?></td>
					<td class="text-center">
						<?php if($row->status=='available') : ?>
							<span class="label label-success">Available</span>
						<?php else : ?>
							<span class="label label-warning">Unavailable</span>
						<?php endif; ?>
					</td>
					<td class="text-center">
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo site_url("product/update/{$row->item_ID}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red open-room-delete" data-id="" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php  
			// End Loop Product
			endforeach;
			?>
			</tbody>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="7">
					<small style="padding-right:20px;">With selected :</small>
					<button name="action" value="set_update" class="btn btn-minier btn-white btn-round btn-primary" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
						<i class="ace-icon fa fa-pencil"></i> <small> Update</small>
					</button>
					<a class="btn btn-minier btn-white btn-round btn-danger room-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
						<i class="ace-icon fa fa-trash-o"></i> <small> Delete</small>
					</a>
					<label class="pull-right">
						<small><i><?php echo count($product) ?> from <?php echo $num_product; ?> data.</i></small>
					</label>
				</th>
			</tr>
			</thead>
		</table>
		<div class="modal" id="modal-delete-multiple">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header bg-delete">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Room</h5>
					</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Are you sure ?
				</p>
			</div>
					<div class="modal-footer text-center">
						<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
						<button name="action" value="delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Yes</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<div class="col-md-12 text-center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>
<div class="modal" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-delete">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Room</h5>
			</div>
			<div class="modal-body">
				<p class="bigger-110 bolder center grey">
					<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i> Are you sure ?
				</p>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-sm pull-right btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
				<a id="button-delete" class="btn btn-sm pull-left btn-danger"><i class="fa fa-trash-o"></i> Yes</a>
			</div>
		</div>
	</div>
</div>

