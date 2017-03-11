jQuery(document).ready(function(){

    var scroll_start = 0;
    var startchange = jQuery('.navbar');
    var offset = startchange.offset();
    jQuery(document).scroll(function() {
        scroll_start = jQuery(this).scrollTop();
        if(scroll_start > offset.top) {
            jQuery('.navbar').addClass('bg-inverse');
        } else {
            jQuery('.navbar').removeClass('bg-inverse');
        }
    });
});