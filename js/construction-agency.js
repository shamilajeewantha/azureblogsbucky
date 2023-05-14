jQuery(document).ready(function($) { 

    /**
     * Add RTL Class in Body
    */
    var brtl = false;
    if ($("body").hasClass('rtl')) { brtl = true; }
    
    $('.cons_light_portfolio-posts').magnificPopup({
        delegate: 'a.cons_light_portfolio-image', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery:{enabled:true}
    });
});
