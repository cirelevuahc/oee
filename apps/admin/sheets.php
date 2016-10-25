<?php

    $manager = new SheetManager( $link );

    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    )
        $sheets = $manager->findAll();
    else
        $sheets = $manager->findAllByIdUser( $_SESSION['user']['id'] );

    $confirm_title  = 'Supprimer';
    $confirm_msg    = 'Etes-vous sûre de vouloir supprimer cette feuille ?';

    require('views/admin/sheets.phtml');

?>