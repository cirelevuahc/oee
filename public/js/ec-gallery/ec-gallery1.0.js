/*
    Name            :    ec-gallery1.0.js
    Author          :    Eric Chauvel
    Date            :    10.2016
    Version         :    1.0
    Revision        :
    e mail          :    eric.chauvel@neuf.fr

    Use whith Jquery library : http://jquery.com/
    If you whant the unpack version, it's free, e mail me.

*/

var ecGallery = {

    galleries : new Array(),

    defaultConfig : {
        topOffset : 0,
    },

    /**
    *  gallery object.
    *
    * @param array config.
    */
    gallery : function (config) {
        this.gallery = null;            //__/ Réference au ecGallery lui même.
        this.id = null;
        if (config == undefined) {     //__/ Configuration du ecGallery.
            this.config = ecGallery.defaultConfig;
        } else {
            this.config = config;
        }
        this.index = 0;
        this.zoom = null;
        this.zoomPlus = null;
        this.zoomMinus = null;
        this.images = null;
        this.image = null;
    },

    /**
     * User events
     */
    event : function( index ) {
        this.eventZoom( index );
    },

    eventZoom : function( index ) {
        ecGallery.galleries[index].zoomPlus.click(function(){
            var actualZoom, actualZoomMem;

            actualZoom = ecGallery.galleries[index].images.attr('class').split('-').pop();
            actualZoomMem = actualZoom;

            actualZoom++;
            if ( actualZoom > 4 ) actualZoom = 4;

            if ( actualZoom != actualZoomMem ) {
                ecGallery.galleries[index].image.each(function(){
                    jQuery(this).attr({
                        'class' : 'gallery-' + actualZoom + '_item',
                    });
                });

                ecGallery.galleries[index].images.attr({'class':'gallery-' + actualZoom });
            }
        });

        ecGallery.galleries[index].zoomMinus.click(function(){
            var actualZoom, actualZoomMem;

            actualZoom = ecGallery.galleries[index].images.attr('class').split('-').pop();
            actualZoomMem = actualZoom;

            actualZoom--;
            if ( actualZoom < 1 ) actualZoom = 1;

            if ( actualZoom != actualZoomMem ) {
                ecGallery.galleries[index].image.each(function(){
                    jQuery(this).attr({
                        'class' : 'gallery-' + actualZoom + '_item',
                    });
                });

                ecGallery.galleries[index].images.attr({'class':'gallery-' + actualZoom });
            }
        });
    },

    updateZoomPosition : function( index ) {
         var scrolltop, position, galleryZoomTop;

         scrolltop = jQuery(document).scrollTop();
         position = ecGallery.galleries[index].gallery.position();

         if ( typeof position === 'undefined' ) return;

         if ( position.top - scrolltop < ecGallery.galleries[index].config.topOffset ) {
            galleryZoomTop = scrolltop - position.top + ecGallery.galleries[index].config.topOffset;

            ecGallery.galleries[index].zoom.css({
                'top' : galleryZoomTop,
            });
         } else {
            ecGallery.galleries[index].zoom.css({
                'top' : 0,
            });
         }
    },

    /**
    * Initialisation.
    *
    * @param object object
    * @param array config
    */
    init : function(object, config){
        var index = ecGallery.galleries.length;

        ecGallery.galleries.push(new ecGallery.gallery(config));
        ecGallery.galleries[index].gallery = object;
        ecGallery.galleries[index].id = jQuery(object).attr("id");
        ecGallery.galleries[index].index = ecGallery.galleries[index].id.split('__').pop();
        ecGallery.galleries[index].zoom = jQuery('#ec_gallery_zoom_' + ecGallery.galleries[index].index);
        ecGallery.galleries[index].zoomPlus = jQuery('#ec_gallery_zoom_plus_' + ecGallery.galleries[index].index);
        ecGallery.galleries[index].zoomMinus = jQuery('#ec_gallery_zoom_minus_' + ecGallery.galleries[index].index);
        ecGallery.galleries[index].images = jQuery('#ec_gallery_images_' + ecGallery.galleries[index].index);
        ecGallery.galleries[index].image = jQuery('#ec_gallery_images_' + ecGallery.galleries[index].index + ' div' );



        ecGallery.event( index );

    },

}

jQuery(window).scroll(function() {
    var length, i;

    length = ecGallery.galleries.length;
    i = 0;
    while ( i < length ) {
        ecGallery.updateZoomPosition( i );

        i++;
    }
});

jQuery(window).resize(function(){
    var length, i;

    length = ecGallery.galleries.length;
    i = 0;
    while ( i < length ) {
        ecGallery.updateZoomPosition( i );

        i++;
    }
});

jQuery.fn.extend({
    addEcGallery: function(config){

       ecGallery.init(this, config);

       return this;
    }
});