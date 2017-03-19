/* global jQuery */

jQuery( document ).ready(function() {
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');
    theme_conrols.on( 'click', '.woo-multiple-select', function () {
        if ( jQuery(this).children(':selected').length === 0 ){
            jQuery('.woo-multiple-select').val('none');
        }
        var values = jQuery('.woo-multiple-select').val();
        if ( values.length > 1 ){
            var index = values.indexOf('none');
            if (index > -1) {
                values.splice(index, 1);
            }
            jQuery('.woo-multiple-select').val(values);
        }
        jQuery(this).trigger('change');
        event.preventDefault();
    });
});