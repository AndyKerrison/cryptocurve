jQuery(document).ready(function() {
        var offset = 500;
        var duration = 500;
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.scrollup').fadeIn(500);
            } else {
                jQuery('.scrollup').fadeOut(500);
            }
        });
        jQuery('.scrollup').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, 500);
            return false;
        })
    });