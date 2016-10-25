jQuery(document).ready(function(){//on attend que la page soit chargée

    configEcSvgIcon.init();
});


var configEcSvgIcon = {
    config1 : {
        color : "#fff",
        colorHover : "#ececec",
        size : "40px",
    },

    init : function(){
        jQuery("[id^='ec_icon_']").each(function(){
            jQuery(this).addEcSvgIcon(configEcSvgIcon.config1);
        });
    },
}
