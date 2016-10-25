jQuery(document).ready(function(){

    main.init();
});

jQuery(window).scroll(function() {
    main.updateHeader();
});

jQuery(window).resize(function(){
    main.updateHeader();

});

var main = {

    logoHeight : 190, // See oee/public/sass/_partial/_login-register.scss  CSS height.
    logoHeightLimit : 0,
    headerMenuHeight : 0,
    breakpointMd : 768, // See oee/public/sass/_partial/_screen-size.scss  CSS breakpoint.

    init : function() {
        jQuery('#sheet-image img').css({'top':0});

        this.headerMenuHeight = 52;
        this.logoHeightLimit = this.logoHeight - this.headerMenuHeight;
        this.updateHeader();

    },

    updateHeader : function() {
        var scrolltop, logoScale;
        var sheetImage, SheetImageTop, sheetImageLimit;

        scrolltop = jQuery(document).scrollTop();;
        sheetImage = jQuery('#sheet-image img');
        sheetImageLimit = sheetImage.height() - this.headerMenuHeight;

        if ( sheetImageLimit < 0 ) sheetImageLimit = 0;

        if ( scrolltop > sheetImageLimit ) {
            SheetImageTop = scrolltop - sheetImage.height() + this.headerMenuHeight;

            console.log('I pass scrolltop=' + scrolltop + ' sheetImageLimit=' + sheetImageLimit);

            sheetImage.css({
                'top' : SheetImageTop
            });
        } else {

            sheetImage.css({
                'top' : 0
            });
        }

        logoScale = 3;
        if ( jQuery('body').width() < this.breakpointMd ) logoScale = 1;

        if ( scrolltop < this.logoHeightLimit * logoScale ) {
            jQuery('#header-image').css({
                'height':( this.logoHeight - scrolltop / logoScale ),
            });
        } else {
            jQuery('#header-image').css({
                'height' : this.headerMenuHeight,
            });
        }
    },


}
