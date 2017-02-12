/*!
* Entry Order
* Kumpulan javascript module Entry Order untuk Waitress
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
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
	* Showing data cart Order
	*/
/*	$.get( base_url + "/entry/get_order/", function( data ) 
	{
		$("span#table-number").html(data.table_number);
	});
*/
	/*
	* Insert Product Item To Cart Order
	*/
	$('td#select-product').click( function() 
	{
		var product = $(this).data('product');

		var product_name = $(this).data('product-name');

		$('div#modal-product-set-quantity').modal('show');

		$('h4#modal-title-product').html(product_name);

		$("input#input-set-product").val(product);

		$("input#input-set-quntity").setCursorToTextEnd();
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
		$('#modal-insert-table').modal('show');
		$('span#modal-table-number').html(table);
		$('button#insert-table').click(function() 
		{
			$.get( base_url + "/entry/insert_table/" + table, function( data ) 
			{
			  	$("span#table-number").html(data.table_number);
			  	$('#modal-insert-table').modal('hide');
			  	$('table#table-cart').attr('data-table', data.table_number);
			  	table_items.ajax.reload();
			});
		})
	});


	/* Rest Order */
	$('button#button-reset').click( function() 
	{
		$('div#modal-cancel-order').modal('show');

		$('button#yes-cancel-order').click( function() 
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
				table_items.ajax.reload();
			});
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

function myFunction() {

}