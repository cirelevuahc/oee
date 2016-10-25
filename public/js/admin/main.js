jQuery(document).ready(function(){

    main.init();

});

//jQuery(window).resize(function(){
//
//});

var main = {

    init : function() {

        this.initConfirmBox();
        this.initImageUpload();
        this.initVideoUpload();
        this.initFileUpload();
        this.initManageMenu();
        this.initUserEditRoleChange();
        this.event();

    },

    initConfirmBox : function() {
        jQuery('#confirm').hide();
    },

    initImageUpload : function() {
        jQuery('#button_image_upload').hide();
        jQuery('.edit-image').hide();

        if ( jQuery('#image_name').val() != '' ) {
            jQuery('.edit-image').show();
        }
    },

    initVideoUpload : function() {
        jQuery('#button_video_upload').hide();
        jQuery('.edit-video').hide();

        if ( jQuery('#video_name').val() != '' ) {
            jQuery('.edit-video').show();
        }
    },

    initFileUpload : function() {
        jQuery('#button_file_upload').hide();
        jQuery('.edit-file').hide();

        if ( jQuery('#file_name').val() != '' ) {
            jQuery('.edit-file').show();
        }
    },

    initManageMenu : function() {
        this.updateMenuOrder();
    },

    initUserEditRoleChange : function() {
        var value;

        value = jQuery('#id_role').val();

        jQuery('[id^="role_description_"]').hide();
        jQuery('#role_description_' + value ).css({'display':'inline-block'});

    },

    event : function() {

        this.eventAlertBox();
        this.eventConfirmBox();
        this.eventImageUpload();
        this.eventVideoUpload();
        this.eventFileUpload();
        this.eventManageMenu();
        this.eventGallerieArticleChange();
        this.eventListNavPageChange();
        this.eventUserEditRoleChange();
    },

    eventListNavPageChange : function() {
        jQuery('#list_nav_page_select').change(function(){
            var value;

            value = jQuery(this).val();
            window.location.href = value;


        });
    },

    eventUserEditRoleChange : function() {
        jQuery('#id_role').change(function(){
            var value;

            value = jQuery(this).val();
            jQuery('[id^="role_description_"]').hide();
            jQuery('#role_description_' + value ).css({'display':'inline-block'});
        });
    },

    eventGallerieArticleChange : function() {
        jQuery('#article_select').change(function(){
            var value;

            value = jQuery(this).val();
            window.location.href = 'galleries_id_' + value;

        });
    },

    eventAlertBox : function() {
        jQuery('#alert_button_close').click(function(){
            jQuery('#alert').hide();
        });
    },

    eventConfirmBox : function() {
        jQuery('#confirm_button_close').click(function(){
            jQuery('#confirm').hide();
        });

        jQuery('[id^="supp_id_"]').click(function(){
            var id = jQuery(this).attr('id').split("_").pop();

            jQuery('#confirm_id').val(id);

            jQuery('#confirm').show();

        });
    },

    eventImageUpload : function() {
        jQuery('#image_upload').change(function(){
            jQuery('#button_image_upload').show();
        });

        jQuery('#button_image_supp').click(function(){
            jQuery('#image_name').val('');
            jQuery('#image').val('');
            jQuery('#image_previous').attr({
                'src':'',
                'alt':'',
            });

            jQuery('.edit-image').hide();
            return false;
        });
    },

    eventVideoUpload : function() {
        jQuery('#video_upload').change(function(){
            jQuery('#button_video_upload').show();
        });

        jQuery('#button_video_supp').click(function(){
            jQuery('#video_name').val('');
            jQuery('#video').val('');
            jQuery('#video_previous').attr({
                'src':'',
                'alt':'',
            });

            jQuery('.edit-video').hide();
            return false;
        });
    },

    eventFileUpload : function() {
        jQuery('#file_upload').change(function(){
            jQuery('#button_file_upload').show();
        });

        jQuery('#button_file_supp').click(function(){
            jQuery('#file_name').val('');
            jQuery('#file').val('');
            jQuery('#file_previous').attr({
                'data':'',
            });

            jQuery('.edit-file').hide();
            return false;
        });
    },

    eventManageMenu : function() {
         jQuery('[id^="menu_hidden_"]').click(function(){
            main.menuHiddenToDisplayed( jQuery(this) );
            jQuery('#menu_order').trigger('menuOrderChange');
        });

        jQuery('[id^="menu_displayed_"]').click(function(){
            main.menuDisplayedToHidden( jQuery(this) );
            jQuery('#menu_order').trigger('menuOrderChange');
        })

        jQuery('[id^="menu_up_"]').click(function(){
            main.menuUp( jQuery(this) );
        });

        jQuery('[id^="menu_down_"]').click(function(){
            main.menuDown( jQuery(this) );
        });

        jQuery('#menu_order').on( 'menuOrderChange',function(){
            main.updateMenuOrder();
        });
    },

    addEventManageMenu : function( id, status ) {
        if( status == 'hidden' ) {
            jQuery('#menu_hidden_' + id).click(function(){
                main.menuHiddenToDisplayed( jQuery(this) );
                jQuery('#menu_order').trigger('menuOrderChange');
            });
        }

        if( status == 'displayed' ) {
            jQuery('#menu_displayed_' + id).click(function(){
                main.menuDisplayedToHidden( jQuery(this) );
                jQuery('#menu_order').trigger('menuOrderChange');
            });
        }

        jQuery('#menu_up_' + id).click(function(){
            main.menuUp( jQuery(this) );
        });

        jQuery('#menu_down_' + id).click(function(){
            main.menuDown( jQuery(this) );
        });
    },

    menuHiddenToDisplayed : function(object) {
        var id, text, length, html;

        id = jQuery(object).attr('id').split('_').pop();
        text = jQuery(object).text();
        length = jQuery('#menus_displayed li').length;
        html = '<li id="menu_' + length + '">';
        html += '<img src="public/images/up.svg" id="menu_up_' + id + '">'
        html += '<img src="public/images/down.svg" id="menu_down_' + id + '">'
        html += '<span id="menu_displayed_' + id + '">' + text + '</span>';
        html += '</li>';
        jQuery('#menus_displayed').append(html);

        main.addEventManageMenu( id, 'displayed' );

        jQuery(object).remove();
    },

    menuDisplayedToHidden : function(object) {
        var id, text, html;

        id = jQuery(object).attr('id').split('_').pop();
        text = jQuery(object).text();
        html = '<li id="menu_hidden_' + id + '"><span>' + text + '</span></li>';
        jQuery('#menus_hidden').append(html);

        main.addEventManageMenu( id, 'hidden' );
        main.updateMenuOrder();

        jQuery(object).parent().remove();
    },

    menuUp : function(object) {
        var id;
        var object1Name, object1Id, object1;
        var object2Name, object2Id, object2;

        id = jQuery(object).attr('id').split('_').pop();

        object1Name = '#' + jQuery(object).parent().attr('id');
        object1Id = parseInt( object1Name.split('_').pop() );

        object2Id = object1Id - 1;
        object2Name = '#menu_' + object2Id;

        object1 = jQuery(object1Name).clone(true);
        object2 = jQuery(object2Name).clone(true);

        object1.attr({'id': 'menu_' + object2Id });
        object2.attr({'id': 'menu_' + object1Id });

        jQuery(object2Name).replaceWith(object1);
        jQuery(object1Name).replaceWith(object2);

        main.updateMenuOrder();
    },

    menuDown : function(object) {
        var id;
        var object1Name, object1Id, object1;
        var object2Name, object2Id, object2;

        id = jQuery(object).attr('id').split('_').pop();

        object1Name = '#' + jQuery(object).parent().attr('id');
        object1Id = parseInt( object1Name.split('_').pop() );

        object2Id = object1Id + 1;
        object2Name = '#menu_' + object2Id;

        object1 = jQuery(object1Name).clone(true);
        object2 = jQuery(object2Name).clone(true);

        object1.attr({'id': 'menu_' + object2Id });
        object2.attr({'id': 'menu_' + object1Id });

        jQuery(object2Name).replaceWith(object1);
        jQuery(object1Name).replaceWith(object2);

        main.updateMenuOrder();
    },

    updateMenuId : function() {

        jQuery('#menus_displayed li').each(function(i){
            jQuery(this).attr({'id':'menu_' + i});
        });

    },

    updateMenuOrder : function() {
        var menuOrder = [];
        var id;

        jQuery('#menus_displayed li').each(function(i){
            id = jQuery('span',this).attr('id').split('_').pop();
            menuOrder.push(id);
        });

        menuOrder = menuOrder.join(';');

        jQuery('#menu_order').val(menuOrder);
    },
}
