<?php
    if ( $setting->getType() == 'text' ) require('views/admin/setting-type-text.phtml');
    if ( $setting->getType() == 'radio' ) {
        $other = unserialize( $setting->getOther() );
        
        require('views/admin/setting-type-radio.phtml');
    }
?>
