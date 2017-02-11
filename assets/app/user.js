/*!
*
* @user user module
* @author Vicky Nitinegoro 
* 
*/

jQuery(function($) {

    // set delete one
    $('.open-user-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/user/delete/' + data_id);
        return false;
    });

    // set delete multiple
    $('.open-delete-multiple').click( function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) {
            $('#modal-delete-multiple').modal('show');
        }
        return false;
    });

    // get form update divisi
    $('.open-role-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete-role').modal('show');
         $('a#button-delete').attr('href', base_url + '/user/deleterole/' + data_id);
        return false;
    });

});


