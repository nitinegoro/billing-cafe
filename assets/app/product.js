/*!
* Module Master
* Kumpulan javascript module Master
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps timepicker
* @see https://github.com/nitinegoro/billing-cafe
*/

jQuery(function($) {
	
	$(".btn-print").printPage();

	// modal delete user
	$('.open-product-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/product/delete/' + $(this).data('id'));
	});

	// open delete multiple
	$('.product-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		} else {
			$.notify({
				title: '<strong><i class="fa fa-warning"></i> Warning!</strong><br>',
				message: 'Empty data selected.'
			},{ 
				type: 'warning',
				animate: {
					enter: 'animated bounceIn',
					exit: 'animated bounceOut'
				}
			});
		}
	});




	// modal delete package
	$('.open-package-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/master/deletepackage/' + $(this).data('id'));
	});

	// delete multiple package
	$('.package-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		}
	})
});