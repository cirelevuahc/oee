<?php

    $manager = new SheetManager( $link );

    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    )
        $sheets = $manager->findAll('menu_order');
    else
        $sheets = $manager->findAllByIdUser( $_SESSION['user']['id'] );


    require('views/admin/manage-menus.phtml');

?>