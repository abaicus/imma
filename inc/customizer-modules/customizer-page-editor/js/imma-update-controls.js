/* global requestpost */
/* global wp */
/* global tinyMCE */

( function( $ ) {
    'use strict';
    wp.customize( 'page_on_front', function( value ) {
        value.bind( function( newval ) {
            $.ajax({
                url: requestpost.ajaxurl,
                type: 'post',
                data: {
                    action: 'imma_ajax_call',
                    pid: newval
                },

                success: function (result) {
                    if(result !== '' && result !== 'undefined' ){
                        result = JSON.parse(result);
                        var id = 'imma_page_editor';
                        var editor = tinyMCE.get(id);

                        editor.setContent(result.post_content);

                        if(result.post_thumbnail !== '' && result.post_thumbnail !== 'undefined'){
                            wp.customize.instance(requestpost.thumbnail_control).set(result.post_thumbnail);
                            var html = '<label for="imma_feature_thumbnail-button">' +
                                '<span class="customize-control-title"> + requestpost.thumbnail_label + </span>' +
                                '</label>' +
                                '<div class="attachment-media-view attachment-media-view-image landscape">' +
                                '<div class="thumbnail thumbnail-image">' +
                                '<img class="attachment-thumb" src="'+result.post_thumbnail+'" draggable="false" alt=""> ' +
                                '</div>' +
                                '<div class="actions">' +
                                '<button type="button" class="button remove-button">Remove</button>' +
                                '<button type="button" class="button upload-button control-focus" id="imma_feature_thumbnail-button">Change Image</button> ' +
                                '<div style="clear:both"></div>' +
                                '</div>' +
                                '</div>';
                            wp.customize.control(requestpost.thumbnail_control).container['0'].innerHTML = html;
                        }

                        wp.customize.instance(requestpost.editor_control).previewer.refresh();
                    }
                }
            });


        } );
    } );
} )( jQuery );

