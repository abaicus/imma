jQuery(document).ready(function(){

    /**
     * Add opacity on header when you scroll
     */
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 500) {
            jQuery('.site-header').addClass("bg-inverse");
        } else {
            jQuery('.site-header').removeClass("bg-inverse");
        }
    });
});