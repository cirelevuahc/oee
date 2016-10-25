jQuery(document).ready(function(){//on attend que la page soit chargée

    configEcGallery.init();
});


var configEcGallery = {
    config1 : {
        topOffset : 0,
    },

    init : function(){
        jQuery("[id^='ec_gallery__']").each(function(){
            configEcGallery.config1.topOffset = main.headerMenuHeight;
            jQuery(this).addEcGallery(configEcGallery.config1);
        });
    },
}
