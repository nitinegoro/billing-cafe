/*!
* Entry Order Untuk Waitress
* Kumpulan javascript module Entry Order untuk Waitress
* @author Vicky Nitinegoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps
* @see https://github.com/nitinegoro/billing-cafe
*/
(function($) {
	/*
	* Set Cursor To right value
	* @source http://stackoverflow.com/questions/4609405/set-focus-after-last-character-in-text-box
	*/
    $.fn.setCursorToTextEnd = function() 
    {
        var $initialVal = this.val();
        this.val($initialVal);
    };

    /*
	* List Table Order
    */
    $.fn.table_list = function(Object) 
    {
		$.get( base_url + "/entry/list_table/", function( data ) 
		{

		});
    };

    /*
	* Set Insert Table To Entry Table
    */
    $.fn.setTableOrder = function(table) 
    {
    	var $dialog = this;

		$dialog.modal('show');

		$('span#modal-table-number').html(table);

		shortcut.add("ENTER", function() 
		{
			$.get( base_url + "/entry/insert_table/" + table, function( data ) 
			{
				$("span#table-number").html(data.table_number);
				$dialog.modal('hide');
				$('table#table-cart').attr('data-table', data.table_number);
				table_items.ajax.reload();
				shortcut.remove("ENTER");
			});
		});

		$('button#insert-table').click(function() 
		{
			$.get( base_url + "/entry/insert_table/" + table, function( data ) 
			{
				$("span#table-number").html(data.table_number);
				$dialog.modal('hide');
				$('table#table-cart').attr('data-table', data.table_number);
				table_items.ajax.reload();
			});
		});
    };

    /*
	* Set Enter From Modal
    */
    $.fn.setEnterModal = function() 
    {
    	var button = this;

    };

    $.fn.delete_order = function() 
    {
		$.get( base_url + "/entry/delete_order/", function( data ) 
		{
			$('div#modal-cancel-order').modal('hide');

			$("span#table-number").html('');

			$.notify({
				title: '<strong><i class="fa fa-check"></i> Success!</strong><br>',
				message: data.message
			},{ 
				type: 'success',
				animate: {
					enter: 'animated fadeIn',
					exit: 'animated bounceOut'
				},
				placement: {
					from: "top",
					align: "center"
				},
			});
		});
    };

})(jQuery);


jQuery(function($) {

   table_items = $('#table-cart').DataTable({ 
        "processing": true, 
        "paging": false,
        "ordering": true,
        "info": false,
        "bInfo": false,
        "bLengthChange": false,
        "searching": false,
        "ajax": {
           "url": base_url + "/entry/get_order",
       	},
	  	"columns": [
	  		null, 
	  		{ className: "text-center" }
	  	],
		footerCallback: function( tfoot, data, start, end, display ) 
		{    
		  	var response = this.api().ajax.json();
		  	if(response)
		  	{
		  		$('span#table-number').html(response['table_number']);
		     	var $th = $(tfoot).find('th');
		     	$th.eq(0).html(response['total_heading']);
		     	$th.eq(1).html(response['total']);
		  	}
		} 
   });

    $('#table-cart tbody').on( 'click', 'span.show-details-btn', function () 
    {
    	var product = $(this).data('id');

    	var product_name = $(this).data('product-name');

    	var quantity =  $(this).data('qty');

    	$("div#modal-product-set-update").modal('show');
		
		$('h4#modal-title-product').html(product_name);

		$("input#input-update-product").val(product);

		$("input#input-update-quntity").val(quantity).setCursorToTextEnd();
       
		/* Update Items From Cart */
        $('button#button-update-cart').click( function(event) 
        {
		  	event.preventDefault();

		    var update_quantity = $("input[name='set_quantity']").val();
		 	
		  	var update_cart = $.post( base_url + '/entry/update_cart/' + product, { quantity: update_quantity } );

		  	// Put the results in a div
		  	update_cart.done(function( data ) 
		  	{
		    	$('div#modal-product-set-update').modal('hide');
		    	table_items.ajax.reload();
		  	});
        });

		shortcut.add("ENTER", function() 
		{
		    var update_quantity = $("input[name='set_quantity']").val();
		 	
		  	var update_cart = $.post( base_url + '/entry/update_cart/' + product, { quantity: update_quantity } );

		  	// Put the results in a div
		  	update_cart.done(function( data ) 
		  	{
		    	$('div#modal-product-set-update').modal('hide');
		    	table_items.ajax.reload();
		    	shortcut.remove("ENTER");
		  	});
		});


        /* Delete Item From cart */
        $('button#button-delete-cart').click(function() 
        {
		  	var update_cart = $.get( base_url + '/entry/delete_from_cart/' + product);

		  	// Put the results in a div
		  	update_cart.done(function( data ) 
		  	{
		    	$('div#modal-product-set-update').modal('hide');
		    	table_items.ajax.reload();
		  	});
        });
    });

	/*
	* Fungsi pencarian Product List
	* @source http://stackoverflow.com/questions/20567426/search-html-table-with-js-and-jquery
	*/
	$('input#search-product').keyup( function() 
	{
        _this = this;
        $.each($("table#table-product-list tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            {
               	$(this).hide();
            }  else {
               	$(this).show();             
            }
        });
	});

	/*
	* Insert Product Item To Cart Order
	*/
	$('td#select-product').click( function() 
	{
		var check_order_table = $.get(base_url + "/entry/get_order");

		check_order_table.done( function(res) 
		{
			if(res.table_number === '')
			{
				$.notify({
					title: '<strong><i class="fa fa-warning"></i> Warning!</strong><br>',
					message: "Please select table number to order."
				},{ 
					type: 'warning',
					animate: {
						enter: 'animated bounce',
						exit: 'animated bounceOut'
					},
					placement: {
						from: "top",
						align: "center"
					},
				});

				return true;
			} else {
				$('div#modal-product-set-quantity').modal('show');
			}
		});

		var product = $(this).data('product');

		var product_name = $(this).data('product-name');

		$('h4#modal-title-product').html(product_name);

		$("input#input-set-product").val(product);

		$("input#input-set-quntity").setCursorToTextEnd();

		shortcut.add("ENTER", function() 
		{
		  	var $form = $("#form-insert-product"),
		    	set_quantity = $form.find("input[name='quantity']").val(),
		    	product = $form.find("input[name='product']").val();
		 
		  	var add_cart = $.post( base_url + '/entry/add_to_cart/' + product, { quantity: set_quantity } );
		 
		  	// Put the results in a div
		  	add_cart.done(function( data ) 
		  	{
		    	$('div#modal-product-set-quantity').modal('hide');
		    	table_items.ajax.reload();
		    	shortcut.remove("ENTER");
		  	});
		});

	});

	// Attach a submit handler to the form
	$("#form-insert-product").submit(function( event ) 
	{
	  	event.preventDefault();
	  	var $form = $( this ),
	    	set_quantity = $form.find("input[name='quantity']").val(),
	    	product = $form.find("input[name='product']").val();
	 
	  	var add_cart = $.post( base_url + '/entry/add_to_cart/' + product, { quantity: set_quantity } );
	 
	  	// Put the results in a div
	  	add_cart.done(function( data ) 
	  	{
	    	$('div#modal-product-set-quantity').modal('hide');
	    	table_items.ajax.reload();
	  	});
	});

	$('a#select-table').click( function() 
	{
		var table = $(this).data('table');
			
		var table_check = $.get( base_url + "/entry/table_check/" + table);

		table_check.done( function(data) 
		{
			if(data.status === true)
			{
				$('div#modal-insert-table').setTableOrder(data.table);
			} 
		});
	});

	$('a#select-table-use').click( function() 
	{
		var table = $(this).data('table');

		$('span#modal-table-number').html(table);
			
		$('div#modal-table-use').modal('show');

		alert("Update Table");

	});


	/* 
	* Reset Order 
	* Or Shortcut Cancel Order 
	* 
	*/
	$('button#button-reset').click( function() 
	{
		$('div#modal-cancel-order').modal('show');

		shortcut.add("ENTER", function() 
		{
			$(this).delete_order();
			table_items.ajax.reload();
			shortcut.remove("ENTER");
		});

		$('button#yes-cancel-order').click( function() 
		{
			$(this).delete_order();
			table_items.ajax.reload();
		});
	});

	shortcut.add("F3", function() {
		$('div#modal-cancel-order').modal('show');

		shortcut.add("ENTER", function() 
		{
			$(this).delete_order();
			table_items.ajax.reload();
			shortcut.remove("ENTER");
		});

		$('button#yes-cancel-order').click( function() 
		{
			delete_order();
			table_items.ajax.reload();
		});
	});

	// modal delete user
	$('.scroll').ace_scroll({
		size: 410
	});
	$('.scroll-product').ace_scroll({
		size: 320
	});
	$('.scroll-item').ace_scroll({
		size: 200
	});
});

