/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function() {
    jQuery('.newUrl').attr('disabled' ,'disabled');
    jQuery('.newPath').attr('disabled' ,'disabled');
    jQuery('.chkChangeUrl').change(function(){
        if ( jQuery(this).is(':checked') ) {
            jQuery('.newUrl').removeAttr('disabled');
            jQuery('.newPath').removeAttr('disabled');
            jQuery('.newUrl').attr('required' , 'required');
            jQuery('.newPath').attr('required' , 'required');
        } else {
            jQuery('.newUrl').removeAttr('required');
            jQuery('.newPath').removeAttr('required');
            jQuery('.newUrl').attr('disabled' ,'disabled');
            jQuery('.newPath').attr('disabled' ,'disabled');
        }
    });
});