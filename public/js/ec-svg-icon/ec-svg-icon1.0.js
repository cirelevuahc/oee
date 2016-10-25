/*
    Name            :    ec-evg-icon1.0.js
    Author          :    Eric Chauvel
    Date            :    01.2015
    Version         :    2.0
    Revision        :
    e mail          :    eric.chauvel@neuf.fr
    
    Use whith Jquery library : http://jquery.com/
    If you whant the unpack version, it's free, e mail me.

*/

var ecSvgIcon = {

    icons : new Array(),

    defaultConfig : {
        color : "#b7b7b7",
        colorHover : "#9a9a9a",
        size : "40px",
        freeze : false,
    },

    /**
    *  icon object.
    *
    * @param array config.
    */
    icon : function (config) {
        this.object = null;            //__/ Réference au ecSvgIcon lui même.
        this.id = null;
        if (config == undefined) {     //__/ Configuration du ecSvgIcon.
            this.config = ecSvgIcon.defaultConfig;
        } else {
            this.config = config;
        }
        this.normal = null;
        this.normalHover = null;
        this.active = null;
        this.activeHover = null;
        this.status = 0;    // 0 -> normal, 1 -> activate.
        this.timeOut = 0;
        this.cptAnimateActive = 0;
        this.nbAnimateActive = 0;
        this.freeze = false;

    },

    supportSvg :function () {
      var div = document.createElement('div');

      div.innerHTML = '<svg/>';

      return (div.firstChild && div.firstChild.namespaceURI) == 'http://www.w3.org/2000/svg';
    },

    /**
     * User events
     */
    event : function( index ) {

        ecSvgIcon.iconHover( index );

        jQuery(ecSvgIcon.icons[index].object).click(function(){
            ecSvgIcon.iconClick( index );
        });
    },

    /**
     * Event icon hover
     *
     * @param int index
     */
    iconHover : function ( index ) {
        jQuery(ecSvgIcon.icons[index].object).hover(function(){

            if ( ecSvgIcon.icons[index].config.colorHover != null ) {
                jQuery(ecSvgIcon.icons[index].object).css( "fill", ecSvgIcon.icons[index].config.colorHover );
                jQuery(ecSvgIcon.icons[index].object).css( "stroke", ecSvgIcon.icons[index].config.colorHover );
            }

            switch (  ecSvgIcon.icons[index].status ) {
                case 0 :
                    jQuery(ecSvgIcon.icons[index].normal).hide();
                    jQuery(ecSvgIcon.icons[index].normalHover).show();
                    break;
                case 1 :
                    jQuery(ecSvgIcon.icons[index].active).hide();
                    jQuery(ecSvgIcon.icons[index].activeHover).show();
                    break;
            }
        },function(){

            if ( ecSvgIcon.icons[index].config.color != null ) {
                jQuery(ecSvgIcon.icons[index].object).css( "fill", ecSvgIcon.icons[index].config.color );
                jQuery(ecSvgIcon.icons[index].object).css( "stroke", ecSvgIcon.icons[index].config.color );
            }

            switch (  ecSvgIcon.icons[index].status ) {
                case 0 :
                    jQuery(ecSvgIcon.icons[index].normal).show();
                    jQuery(ecSvgIcon.icons[index].normalHover).hide();
                    break;
                case 1 :
                    jQuery(ecSvgIcon.icons[index].active).show();
                    jQuery(ecSvgIcon.icons[index].activeHover).hide();
                    break;
            }
        });
    },

    /**
     * Event icon click
     *
     * @param int index
     */
    iconClick : function( index ) {

        if (ecSvgIcon.icons[index].freeze ) return;

        ecSvgIcon.icons[index].status = 1 - ecSvgIcon.icons[index].status;

        switch (  ecSvgIcon.icons[index].status ) {
            case 0 :
                ecSvgIcon.animate( index, 1 );
                break;
            case 1 :
                ecSvgIcon.animate( index, 0 );
                break;
        }
    },

    /**
     * Animate icon transition between normal and active or active and normal ( depend dir value )
     *
     * @param int index
     * @param int dir  O -> to active stat 1 -> to normal stat.
     */
    animate: function ( index, dir ) {
        dir = typeof dir !== 'undefined' ?  dir : 0;

        jQuery(ecSvgIcon.icons[index].normal).hide();
        jQuery(ecSvgIcon.icons[index].normalHover).hide();
        jQuery(ecSvgIcon.icons[index].activeHover).hide();
        jQuery("[id^='a']", ecSvgIcon.icons[index].active).hide();
        jQuery("#a" + ( ecSvgIcon.icons[index].cptAnimateActive + 1 ), ecSvgIcon.icons[index].active).show();
        jQuery(ecSvgIcon.icons[index].active).show();

        if ( dir == 0 ) {
            ecSvgIcon.icons[index].cptAnimateActive++;
            if ( ecSvgIcon.icons[index].cptAnimateActive >= ecSvgIcon.icons[index].nbAnimateActive) {
                clearTimeout( ecSvgIcon.icons[index].timeOut );
                return;
            }
        }

        if ( dir == 1 ) {
            ecSvgIcon.icons[index].cptAnimateActive--;
            if ( ecSvgIcon.icons[index].cptAnimateActive < 0 ) {
                ecSvgIcon.icons[index].cptAnimateActive = 0;
                clearTimeout( ecSvgIcon.icons[index].timeOut );
                jQuery(ecSvgIcon.icons[index].normal).show();
                jQuery(ecSvgIcon.icons[index].active).hide();
                return;
            }
        }

        ecSvgIcon.icons[index].timeOut = setTimeout( "ecSvgIcon.animate(" +  index + "," +  dir +")", 50 );
    },

    /**
     * Get status icon
     *
     * @param string id
     *
     * @return int status
     */
    getStatus : function ( id ) {
        var i;

        for ( i = 0 ; i < ecSvgIcon.icons.length ; i++) {
            if ( ecSvgIcon.icons[i].id == id ) {
                return  ecSvgIcon.icons[i].status;
            }
        }
    },

    /**
     * Set freeze flag
     *
     * @param string id
     * @param boolean value
     */
    setFreeze : function ( id, value ) {
        var i;

        for ( i = 0 ; i < ecSvgIcon.icons.length ; i++) {
            if ( ecSvgIcon.icons[i].id == id ) {
                ecSvgIcon.icons[i].freeze = value;
            }
        }
    },

    /**
     * Set size icon
     *
     * @param string id
     * @param boolean value
     */
    setSize : function ( id, value ) {
        var i;

        for ( i = 0 ; i < ecSvgIcon.icons.length ; i++) {
            if ( ecSvgIcon.icons[i].id == id ) {
                ecSvgIcon.icons[i].object.css("width", value + "px");
                ecSvgIcon.icons[i].object.css("height", value + "px");
            }
        }
    },

    /**
    * Initialisation.
    *
    * @param object object
    * @param array config
    */
    init : function(object, config){
        var index = ecSvgIcon.icons.length;

        ecSvgIcon.icons.push(new ecSvgIcon.icon(config));
        ecSvgIcon.icons[index].object = object;
        ecSvgIcon.icons[index].id = jQuery(object).attr("id");

        ecSvgIcon.icons[index].normal = jQuery("#normal",ecSvgIcon.icons[index].object);
        ecSvgIcon.icons[index].normalHover = jQuery("#normal_hover",ecSvgIcon.icons[index].object);
        ecSvgIcon.icons[index].active = jQuery("#active",ecSvgIcon.icons[index].object);
        ecSvgIcon.icons[index].activeHover = jQuery("#active_hover",ecSvgIcon.icons[index].object);
        ecSvgIcon.icons[index].nbAnimateActive = jQuery("[id^='a']", ecSvgIcon.icons[index].active).length;

        jQuery(ecSvgIcon.icons[index].normal).show();
        jQuery(ecSvgIcon.icons[index].normalHover).hide();
        jQuery(ecSvgIcon.icons[index].active).hide();
        jQuery(ecSvgIcon.icons[index].activeHover).hide();
        jQuery("[id^='a']", ecSvgIcon.icons[index].active).hide();

        jQuery(ecSvgIcon.icons[index].object).css("fill",ecSvgIcon.icons[index].config.color);
        jQuery(ecSvgIcon.icons[index].object).css("stroke",ecSvgIcon.icons[index].config.color);
        jQuery(ecSvgIcon.icons[index].object).css("width",ecSvgIcon.icons[index].config.size);
        jQuery(ecSvgIcon.icons[index].object).css("height",ecSvgIcon.icons[index].config.size);

        ecSvgIcon.event( index );

    },

    /**
     * Update icon position
     *
     * @param string id
     * @param int status
     *
     */
    update: function ( id, status ) {
        status = typeof status !== 'undefined' ?  status : null;

        var i;

        for ( i = 0 ; i < ecSvgIcon.icons.length ; i++) {
            if ( ecSvgIcon.icons[i].id == id ) {
                if ( status == null ) {
                    ecSvgIcon.iconClick( i );
                } else {
                    if ( ecSvgIcon.icons[i].status != status ) ecSvgIcon.iconClick( i );
                }
            }
        }
    },

}

jQuery.fn.extend({
    addEcSvgIcon: function(config){

       ecSvgIcon.init(this, config);

       return this;
    }
});