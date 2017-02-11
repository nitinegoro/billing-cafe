<div class="row">
	<div class="col-md-4 scroll">
		<div class="col-md-11 col-md-offset-2">
			<p>
				<label><i class="glyphicon glyphicon-stop green"></i> : </label> Order Bags 
				<label><i class="glyphicon glyphicon-stop blue"></i> : </label> Available 
				<label><i class="glyphicon glyphicon-stop red"></i> : </label> Unavailable
			</p>
		</div>
		<div style="padding-left:50px; ">
		<a class="btn btn-round btn-success" style="margin:5px;">
			<img src="<?php echo base_url('assets/img/bags-icon.png'); ?>" alt=""><br> <span>Order</span>
		</a>
	<?php  
	/**
	 * Loop Table From Options Table
	 *
	 **/
	for($table =1; $table <= $this->app->get('table_count'); $table++) :
	?>
		<a class="btn btn-round btn-primary" style="margin:5px;">
			<img src="<?php echo base_url('assets/img/table-icon.png'); ?>" alt=""><br><span>No. <?php echo $table; ?></span>
		</a>
	<?php  
	endfor;
	?>
		</div>
	</div>
	<div class="col-md-4">
		<table class="table table-hover table-bordered font-medium" style="margin-bottom: 0px;">
			<thead>
				<tr>
					<th class="text-center">Products</th>
					<th class="text-center" width="150">Price</th>
				</tr>
				<tr>
					<td colspan="2">
						<span style="width:100%;" class="input-icon">
							<input type="text" placeholder="Search ..." class="nav-search-input form-control"  />
							<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>		
					</td>
				</tr>
			</thead>
		</table>
		<div class="scroll-product">
		<table class="table table-hover table-bordered font-medium">
			<tbody>
	<?php  
	/**
	 * Loop Table From Options Table
	 *
	 **/
	for($table =1; $table <= $this->app->get('table_count'); $table++) :
	?>
				<tr>
					<td class="show-details-btn pointer">Lorem ipsum dolor sit amet.</td>
					<td class="text-center" width="150">Rp. 23,000</td>
				</tr>
	<?php  
	endfor;
	?>
			</tbody>
		</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="search-area well well-sm" style="min-height: 410px;">
			<div class="search-filter-header bg-primary">
				<h5 class="smaller no-margin-bottom">
					<i class="ace-icon fa fa-plus white"></i> New Transaction 
				</h5>
			</div>
			<div class="space-10"></div>
			<table class="table table-striped table-bordered" style="margin-bottom: 0px;">
				<tbody>
					<tr>
						<th colspan="2" class="text-center"> Table Nomber : 1 </th>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped table-bordered" style="margin-bottom: 0px;">
				<thead class="thin-border-bottom">
					<tr>
						<th class="text-center"> Items </th>
						<th width="150" class="text-center"> Price </th>
					</tr>
				</thead>
			</table>
			<div class="scroll-item" style="background-color: white">
			<table class="table table-hover table-bordered" style="margin-bottom: 0px;">
				<tbody id="table-cart">
	<?php  
	/**
	 * Loop Table From Options Table
	 *
	 **/
	for($table =1; $table <= 0; $table++) :
	?>
				<tr>
					<td class="show-details-btn pointer">Lorem ipsum dolor sit amet.</td>
					<td class="text-center" width="150">Rp. 23,000</td>
				</tr>
	<?php  
	endfor;
	?>
				</tbody>
			</table>
			</div>
			<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<th><span class="pull-right">Total :</span> </th>
						<td width="150"><span class="tprice">Rp. 0,00</span></td>
					</tr>
				</tbody>
			</table>
			<?php  
			echo form_open(site_url('transaction/setbooking'), array('class' => 'form-horizontal'));
			?>
			<div class="col-md-12">
				<label for="request" class="control-label">Extra Request (Optional)</label>
				<textarea name="request" id="input-optional" class="form-control input-sm" rows="3"></textarea>
			</div>
			<div class="hr hr-dotted col-md-12"></div>
			<div class="text-center">
				<button type="reset" id="button-reset" class="btn btn-danger btn-round" style="padding:10px; width:40%; font-size: 1.2em;">
					<i class="ace-icon fa fa-remove"></i> Delete
				</button>
				<button type="submit" class="btn btn-success btn-round" style="padding:10px; width:40%; font-size: 1.2em;">
					<i class="ace-icon glyphicon glyphicon-floppy-saved"></i> Save Order
				</button>
			</div>
			<?php  
			echo form_close();
			?>
			<div class="space-4"></div>
		</div>
	</div>
	</div>
</div>
<!-- 
<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
<div class="modal animated fadeIn" id="modal-id" style="top:23%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Lorem ipsum dolor sit amet, consectetur adipisicing.</h4>
			</div>
			<div class="modal-body">
				<label for="quantity">Quantity :</label>
				<input type="number" name="quantity" class="form-control input-lg" value="1" autofocus="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
	</div>
</div>
<!-- 
<a class="btn btn-primary" data-toggle="modal" href='#modal-update'>Trigger modal</a> -->
<div class="modal animated fadeIn" id="modal-update" style="top:20%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Table Number : 4</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-block btn-round btn-success"><i class="fa fa-edit pull-left"></i> Update Cart</button>
				<button type="button" class="btn btn-lg btn-block btn-round btn-primary"><i class="fa fa-exchange pull-left"></i> Join Table</button>
				<button type="button" class="btn btn-lg btn-block btn-round btn-default" data-dismiss="modal"><i class="fa fa-undo pull-left"></i> Close Dialog</button>
			</div>
		</div>
	</div>
</div>