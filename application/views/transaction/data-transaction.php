<div class="row">
	<div class="col-md-6 col-md-offset-3"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="col-md-2">
			<label>Show </label>
			<select name="per_page" id="input" class="select-page" onchange="window.location = '<?php echo site_url('report_transactions?per_page='); ?>' + this.value + '&query=<?php echo $this->input->get('query'); ?>&category=<?php echo $this->input->get('category') ?>';">
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
		<div class="col-md-7">
			<a href="<?php echo site_url('product/get_print') ?>" class="btn-print btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon glyphicon glyphicon-print gray"></i> Print
			</a>
			<a href="<?php echo site_url('product/export') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round">
				<i class="ace-icon fa fa-file-excel-o gray"></i> Export To Excel
			</a>
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
	</div>
	<div class="col-md-12" style="margin-bottom: 20px;">
		<div class="col-md-4">
				<div class="input-daterange input-group">
					<input type="text" class="input-sm form-control" name="from" value="<?php echo $this->input->get('from') ?>" placeholder="From date" />
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<span class="input-group-addon"><i class="fa fa-exchange"></i></span>
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" class="input-sm form-control" name="end" value="<?php echo $this->input->get('end') ?>" placeholder="End date" />
				</div>
			<div class="space-4"></div>
		</div>
		<div class="col-md-2">
			<select name="status" id="input" class="select-page col-md-12">
				<option value="">-- Payment Method --</option>
				<option value="available" <?php if($this->input->get('status')=='available') echo "selected"; ?>>Available</option>
				<option value="unavailable" <?php if($this->input->get('status')=='unavailable') echo "selected"; ?>>Unavailable</option>
			</select>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3">
			<select name="status" id="input" class="select-page col-md-12">
				<option value="">-- Cashier --</option>
				<option value="available" <?php if($this->input->get('status')=='available') echo "selected"; ?>>Available</option>
				<option value="unavailable" <?php if($this->input->get('status')=='unavailable') echo "selected"; ?>>Unavailable</option>
			</select>
			<div class="space-4"></div>
		</div>
		<div class="col-md-3">
			<button class="btn btn-white btn-default btn-bold btn-sm btn-round"><i class="fa fa-filter"></i> Filter</button>
			<a href="<?php echo site_url('report_transactions') ?>" class="btn btn-white btn-default btn-bold btn-sm btn-round"><i class="fa fa-times"></i> Reset</a>
			<div class="space-4"></div>
		</div>
	</div>
	<?php 
	echo form_close();
	?>
	<div class="col-md-12">
		<?php echo form_open(site_url('report_transactions/bulk_action'));  ?>
		<table class="table table-bordered mini-font">
			<thead>
				<tr>
					<th rowspan="2" width="30">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>
					</th>
					<th rowspan="2" width="120" class="text-center">ID</th>
					<th rowspan="2" class="text-center" width="100">Date</th>
					<th rowspan="2" class="text-center">Customer Name</th>
					<th rowspan="2" class="text-center" width="120">Discount</th>
					<th colspan="2" class="text-center">Items</th>
					<th rowspan="2" class="text-center">PPN Tax</th>
					<th rowspan="2" class="text-center">Total</th>
					<th rowspan="2" width="120" class="text-center">Payment Method</th>
					<th rowspan="2" class="text-center">Cashier</th>
				</tr>
				<tr>
					<th class="text-center">Product Item</th>
					<th class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="4">
						<label class="pos-rel">
							<input type="checkbox" class="ace" /> <span class="lbl"></span>
						</label>	
					</td>
					<td rowspan="4" class="text-center">00001</td>
					<td rowspan="4" class="text-center">01/12/2017 2:30 PM</td>
					<td rowspan="4">lorem</td>
					<td rowspan="4" class="text-center">10</td>
					<td>Bilitong Black Special x 1</td>
					<td class="text-center">Rp. 89,000</td>
					<td rowspan="4" class="text-center">Rp. 3,200</td>
					<td rowspan="4" class="text-center">Rp. 97,000</td>
					<td rowspan="4" class="text-center">Cash</td>
					<td rowspan="4">Vicky Nitinegoro</td>
				</tr>
				<tr>
					<td>Bilitong Black Special x 1</td>
					<td class="text-center">Rp. 89,000</td>
				</tr>
				<tr>
					<td>Bilitong Black Special x 1</td>
					<td class="text-center">Rp. 89,000</td>
				</tr>
				<tr>
					<td>Bilitong Black Special x 1</td>
					<td class="text-center">Rp. 89,000</td>
				</tr>
			</tbody>
			<thead>
			<tr>
				<th>
					<label class="pos-rel">
						<input type="checkbox" class="ace" /> <span class="lbl"></span>
					</label>
				</th>
				<th colspan="13">
					<small style="padding-right:20px;">With selected :</small>
					<a class="btn btn-minier btn-white btn-round btn-danger product-delete-multiple" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete">
						<i class="ace-icon fa fa-trash-o"></i> <small> Delete</small>
					</a>
					<label class="pull-right">
						<small><i><?php echo count($transactions) ?> from <?php echo $num_transactions; ?> data.</i></small>
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
						<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Product Selected </h5>
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
				<h5 class="modal-title"><i class="fa fa-question-circle"></i> Delete Product</h5>
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

