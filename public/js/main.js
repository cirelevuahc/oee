jQuery(document).ready(function(){

    svgIcon.init();
    smallMenu.init();
    main.init();
});

jQuery(window).scroll(function() {
    main.updateHeader();
});

jQuery(window).resize(function(){
    smallMenu.menuUpdate();
    main.updateHeader();

});

var main = {

    logoHeight : 190, // See oee/public/sass/_partial/_login-register.scss  CSS height.
    logoHeightLimit : 0,
    headerMenuHeight : 0,
    breakpointMd : 768, // See oee/public/sass/_partial/_screen-size.scss  CSS breakpoint.

    init : function() {
        if ( jQuery('body').width() < this.breakpointMd ) {
            jQuery('#header-menu').show();
            this.headerMenuHeight = jQuery('#header-menu li:first').height();
            jQuery('#header-menu').hide();
        } else {
            this.headerMenuHeight = jQuery('#header-menu li:first').height();
        }

        jQuery('#sheet-image img').css({'top':0});

        this.logoHeightLimit = this.logoHeight - this.headerMenuHeight;
        this.updateHeader();

        this.event();
    },

    updateHeader : function() {
        var scrolltop, logoScale;
        var sheetImage, SheetImageTop, sheetImageLimit;

        scrolltop = jQuery(document).scrollTop();
        sheetImage = jQuery('#sheet-image img');
        sheetImageLimit = sheetImage.height() - this.headerMenuHeight;

        if ( sheetImageLimit < 0 ) sheetImageLimit = 0;

        if ( scrolltop > sheetImageLimit ) {
            SheetImageTop = scrolltop - sheetImage.height() + this.headerMenuHeight;

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

    event : function() {
        this.eventAlertBox();
        this.eventNewsletterDetail();
        this.eventReportDetail();
    },

    eventAlertBox : function() {
        jQuery('#alert_button_close').click(function(){
            jQuery('#alert').hide();
        });
    },

    eventNewsletterDetail : function() {
        jQuery('.newsletter-list').click(function(e){
            var href;

            href = jQuery(this).attr('href');

            jQuery.ajax({
                url: href,
                type:'GET',
                data: {
                    'ajax' : true,
                    'page' : 'newsletter-detail',
                },
                success:function(data) {
                    jQuery('#newsletter-detail').html(data);
                },
                error: function(errorThrown){
                    //console.log(errorThrown);
                }
            });

            return false;
        });
    },

    eventReportDetail : function() {
        jQuery('.report-list').click(function(e){
            var href;

            href = jQuery(this).attr('href');

            jQuery.ajax({
                url: href,
                type:'GET',
                data: {
                    'ajax' : true,
                    'page' : 'report-detail',
                },
                success:function(data) {
                    jQuery('#report-detail').html(data);
                },
                error: function(errorThrown){
                    //console.log(errorThrown);
                }
            });

            return false;
        });
    },

}

/**
 * Dispay icon.
 */
var svgIcon = {
    /**
     * Svg Icon Paramaters.
     */
    configHamburgerMultiply : {
        color : '#fff',
        colorHover : '#f20c5a',
        size : '52px',

    },

    configRightDownTriangle : {
        color :'#fff',
        colorHover : '#f20c5a',
        size : '30px',
        freeze : false,
    },

    /**
     * Init Svg Icon.
     */
    init : function(){
        var self = this;

        jQuery('#small-menu-icon').addEcSvgIcon(this.configHamburgerMultiply);

        jQuery('[id^="sub-menu-icon-"]').each(function(){
            jQuery(this).addEcSvgIcon(self.configRightDownTriangle);
        });
    },

}

/**
 * Use to work with  tiny menu like phone an tablette.
 */
var smallMenu = {

    init : function() {
        this.menuUpdate();
        this.event();
    },

    event : function() {
        jQuery('#header-small-menu').click( function(e) {
            var icon = jQuery('svg', this ).attr('id');
            var isDisplayBlock = jQuery('#header-menu').css('display');

            if ( isDisplayBlock == 'none' ) {
                ecSvgIcon.update( icon, 1 );
                jQuery('#header-menu').css({'display':'block'});
            } else {
                ecSvgIcon.update( icon, 0 );
                jQuery('#header-menu').css({'display':'none'});

            }

            smallMenu.closeSubMenu();

            e.preventDefault();
        });

        jQuery('.menu-has-children > a').click(function(){

            if ( jQuery('#header-small-menu').css('display') == 'block' ) {
                var icon = jQuery('svg',this).attr('id');

                var attribut = jQuery(this).attr('class');
                if ( attribut == undefined ) attribut = '';

                var isShowMenu = attribut.search('show-sub-menu');

                if ( isShowMenu == -1 ) {
                    ecSvgIcon.update( icon, 1 );
                    jQuery(this).next().show();
                } else {
                    ecSvgIcon.update( icon, 0 );
                    jQuery(this).next().hide();
                }

                jQuery(this).toggleClass('show-sub-menu');
            }

            return false;
        });

    },

    closeSubMenu : function () {

        jQuery('.menu-has-children ul').hide();

        jQuery('[id^="sub-menu-icon-"]').each(function(){
            var icon = jQuery(this).attr('id');

            ecSvgIcon.update( icon, 0 );
        });

        jQuery('.menu-item-has-children > a').removeClass('show-sub-menu');
    },

    menuUpdate : function() {
        if ( jQuery('#header-small-menu').css('display') == 'block' ) {

            if ( ecSvgIcon.getStatus('small-menu-icon') == 0 ) {

                jQuery('.menu-has-children ul').hide();
            }

            jQuery('[id^="sub-menu-icon-"]').each(function(){
                var icon = jQuery(this).attr('id');
                ecSvgIcon.setFreeze( icon, false );
                ecSvgIcon.setSize( icon, 30 );
            });


        } else {
            jQuery('#header-menu').removeAttr('style');
            jQuery('.menu-has-children ul').removeAttr('style');

            var icon = jQuery('svg', '#header-small-menu' ).attr('id');
            ecSvgIcon.update( icon, 0 );

            jQuery('[id^="sub-menu-icon-"]').each(function(){
                var icon = jQuery(this).attr('id');
                ecSvgIcon.update( icon, 1 );
                ecSvgIcon.setSize( icon, 0 );
            });

        }
    },
}