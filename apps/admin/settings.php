<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    ) {
        if ( $_SESSION['user']['role'] == 1 ) {
            $manager = new SettingManager( $link );
            $settings = $manager->findAll();

            require('views/admin/settings.phtml');
        }

    }

?>