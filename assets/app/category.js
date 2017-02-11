/*!
* Category Crud
* Kumpulan javascript module Report
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps timepicker
* @see https://github.com/nitinegoro/billing-cafe
*/

jQuery(function($) {

	// open delte payment
	$('.open-category-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/sell_category/delete/' + $(this).data('id'));
	});

	// Delete Multiple Payments
	$('.category-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) 
		{
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
});