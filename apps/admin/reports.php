<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    ) {
        $manager = new ReportManager( $link );

        $reports = $manager->findAll();


        $confirm_title  = 'Supprimer';
        $confirm_msg    = 'Etes-vous sûre de vouloir supprimer ce rapport ?';

        require('views/admin/reports.phtml');
    }
?>