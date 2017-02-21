<div class="row">
	<div class="col-md-4">
		<div class="col-md-11 col-md-offset-2">
			<p>
				<label><i class="fa fa-refresh"></i> : </label> F5 (Refresh)
				<label><i class="glyphicon glyphicon-stop blue"></i> : </label> Ready 
				<label><i class="glyphicon glyphicon-stop red"></i> : </label> Already in Use
			</p>
		</div>
		<div class="scroll" style="padding-left:50px;" id="block-list-table">
	<?php  
	/**
	 * Loop Table From Options Table
	 *
	 **/
	for($table =1; $table <= $this->app->get('table_count'); $table++) :

		/**
		 * Check Status Meja
		 *
		 * @param Integer (Nomor table)
		 * @param String (status)
		 **/
		if($this->entry->table_check($table, 'pre')->num_rows()) :
			$order = $this->entry->table_check($table, 'pre')->row();
	?>
		<a id="select-table-use" class="btn btn-round btn-danger" style="margin:5px;" data-table="<?php echo $table; ?>" data-order="<?php echo $order->order_ID; ?>">
			<img src="<?php echo base_url('assets/img/table-icon.png'); ?>" alt=""><br><span>No. <?php echo $table; ?></span>
		</a>
	<?php  
		else :
	?>
		<a id="select-table" class="btn btn-round btn-primary" style="margin:5px;" data-table="<?php echo $table; ?>">
			<img src="<?php echo base_url('assets/img/table-icon.png'); ?>" alt=""><br><span>No. <?php echo $table; ?></span>
		</a>
	<?php
		endif;
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
							<input id="search-product" type="text" placeholder="Search ..." class="nav-search-input form-control"  />
							<i class="ace-icon fa fa-search nav-search-icon"></i>
						</span>		
					</td>
				</tr>
			</thead>
		</table>
		<div class="scroll-product">
		<table id="table-product-list" class="table table-hover table-bordered font-medium">
			<tbody>
	<?php  
	/**
	 * Loop Table From Options Table
	 *
	 **/
	foreach($this->entry->get_product_items() as $row) :
	?>
				<tr>
					<td id="select-product" class="show-details-btn pointer" data-product="<?php echo $row->item_ID; ?>" data-product-name="<?php echo $row->product_name; ?>">
						<?php echo $row->product_name; ?>	
					</td>
					<td class="text-center" width="150">Rp. <?php echo number_format($row->price) ?></td>
				</tr>
	<?php  
	endforeach;
	?>			
			</tbody>
		</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="search-area well well-sm" style="min-height: 410px;">
			<div class="scroll-product">
			<table id="table-cart" class="table table-hover table-bordered" style="margin-top: -30px;background-color: white">
				<thead>
					<tr>
						<th colspan="2" class="text-center"><span id="table-number"></span></th>
					</tr>
					<tr>
						<th class="text-center" style="color: #444">Items</th>
						<th class="text-center" style="color: #444">Price</th>
					</tr>
				</thead>
				<tbody> </tbody>
				<tfoot>
					<tr><th></th><th></th></tr>
				</tfoot>
			</table>
			</div>
			<?php  
			echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-order-cart'));
			?>
			<div class="col-md-12">
				<label for="set_request" class="control-label">Extra Request (Optional)</label>
				<textarea name="set_request" id="input-optional" class="form-control input-sm" rows="3"></textarea>
			</div>
			<div class="hr hr-dotted col-md-12"></div>
			<div class="text-center">
				<button type="reset" id="button-reset" class="btn btn-block btn-danger btn-round" style="width:38%; font-size: 1.2em;">
					<i class="ace-icon fa fa-remove"></i> Delete (F3)
				</button>
				<button type="button" id="button-save-order" class="btn btn-block btn-success btn-round" style="margin-top: 0px; width:46%; font-size: 1.2em;">
					<i class="ace-icon glyphicon glyphicon-floppy-saved"></i> Save (F4)
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
<!-- Insert Table To cart -->
<div class="modal animated fadeIn" id="modal-insert-table" style="top:20%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Select Table Number <span id="modal-table-number"></span> ?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-round btn-default pull-left" data-dismiss="modal"><i class="fa fa-times pull-left"></i> Close Dialog</button>
				<button type="button" id="insert-table" class="btn btn-round btn-primary pull-right"><i class="fa fa-check pull-left"></i> Select Table</button>
			</div>
		</div>
	</div>
</div>
<!-- Destroy Cart Dialog -->
<div class="modal animated fadeIn" id="modal-cancel-order" style="top:20%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content bg-delete">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cancel Order?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-round btn-default pull-left" data-dismiss="modal"><i class="fa fa-times pull-left"></i> Cancel</button>
				<button type="button" id="yes-cancel-order" class="btn btn-round btn-danger pull-right"><i class="fa fa-check pull-left"></i> Yes</button>
			</div>
		</div>
	</div>
</div>

<!-- Dialog Product from List  -->
<div class="modal animated fadeIn" id="modal-product-set-quantity" style="top:23%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
	<?php echo form_open(site_url(''), array('id' => 'form-insert-product')); ?>
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title" id="modal-title-product"></h4>
			</div>
			<div class="modal-body">
				<label for="quantity">Quantity :</label>
				<input id="input-set-quntity" type="number" name="quantity" class="form-control input-lg" value="1" autofocus="">
				<input id="input-set-product" type="hidden" name="product"> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Insert</button>
			</div>
		</div>
	<?php form_close(); ?>
	</div>
</div>

<!-- Dialog Product from Cart  -->
<div class="modal animated fadeIn" id="modal-product-set-update" style="top:23%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
	<?php echo form_open(site_url(''), array('id' => 'form-update-product')); ?>
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title" id="modal-title-product"></h4>
			</div>
			<div class="modal-body">
				<label for="quantity">Quantity :</label>
				<input id="input-update-quntity" type="number" name="set_quantity" class="form-control input-lg" width="50" value="" autofocus="">
				<input id="input-update-product" type="hidden" name="product">	
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="button" id="button-delete-cart" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
				<button type="button" id="button-update-cart" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Update</button>
			</div>
		</div>
	<?php form_close(); ?>
	</div>
</div>


<!-- Modal Select Table Use  -->
<div class="modal animated fadeIn" id="modal-table-use" style="top:20%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Table <span id="modal-table-number"></span> in used, select for actions!</h4>
			</div>
			<div class="modal-footer">
				<button type="button" id="update-table-order" class="btn btn-lg btn-block btn-round btn-success"><i class="fa fa-edit pull-left"></i> Update Cart</button>
				<button type="button" class="btn btn-lg btn-block btn-round btn-primary"><i class="fa fa-exchange pull-left"></i> Join Table</button>
				<button type="button" class="btn btn-lg btn-block btn-round btn-default" data-dismiss="modal"><i class="fa fa-undo pull-left"></i> Close Dialog</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal Dialog Print Or Close  -->
<div class="modal animated fadeIn" id="modal-print" style="top:20%;" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-footer">
				<a href="" class="btn btn-lg btn-round btn-primary btn-print pull-right"> Print</a>
				<button type="button" class="btn btn-lg btn-close btn-round btn-default pull-left" data-dismiss="modal"> Close</button>
			</div>
		</div>
	</div>
</div>

