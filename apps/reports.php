<?php

    if ( $sheet->getReport() == 0 ) return;

    if ( isset( $_SESSION['user']['status'] ) && $_SESSION['user']['status'] == 1 ) {

        if ( isset( $_SESSION['user']['capability']['member'] ) && $_SESSION['user']['capability']['member'] == 1 ) {
            $manager    = new ReportManager( $link );
            $reports   = $manager->findBySheet( $sheet );
            require('views/reports.phtml');
        }
    }



?>