<?php
    if ( isset( $_GET['rp'] ) ) {
        $id_report = intval( $_GET['rp'] );
        $manager   = new ReportManager( $link );
        $report    = $manager->findById( $id_report );

        if( $report == null ) {
            $report = $manager->findFirst();
        }

        require('views/report-detail.phtml');
    }
?>