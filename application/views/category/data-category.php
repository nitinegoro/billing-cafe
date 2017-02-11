<div class="row">
	<div class="col-md-6 col-md-offset-3"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="col-md-7">
			<a href="<?php echo site_url('sell_category/create') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-plus gray"></i> Add New Record
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
		<?php echo form_open(site_url('sell_category/bulk_action'));  ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th class="text-center">Category Name</th>
					<th class="text-center">Description</th>
					<th class="text-center">Product</th>
					<th width="80" class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php  
			/**
			 * Loop Product Item
			 *
			 **/
			foreach($category as $row) :
			?>
				<tr>
					<td>
						<label class="pos-rel">
							<input type="checkbox" class="ace" name="sales[]" value="<?php echo $row->ps_ID; ?>" /> <span class="lbl"></span>
						</label>
					</td>
					<td><?php echo $row->product_sales; ?></td>
					<td><?php echo $row->description_sales; ?></td>
					<td class="text-center"><?php echo $this->db->get_where('product_item', array('ps_ID' => $row->ps_ID))->num_rows(); ?></td>
					<td class="text-center">
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="green" href="<?php echo site_url("sell_category/update/{$row->ps_ID}") ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>
							<a class="red open-category-delete" data-id="<?php echo $row->ps_ID; ?>" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
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
					<a class="btn btn-minier btn-white btn-round btn-danger category-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
						<i class="ace-icon fa fa-trash-o"></i> <small> Delete</small>
					</a>
					<label class="pull-right">
						<small><i><?php echo count($category) ?> from <?php echo $num_category; ?> data.</i></small>
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
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Category Selected </h5>
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
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Category</h5>
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

