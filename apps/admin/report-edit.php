<?php
    if ( isset( $_GET['id'] ) ) {

        $id = $_GET['id'];

        if ( $id == 0 ) {
            $report = new Report( $link );
            $report_action = 'new';

        } else {
            $manager = new ReportManager( $link );
            $report = $manager->findById( $id );
            $report_action = 'modify';
        }

        if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
            else $id = $report->getId();

        if ( isset( $_POST['id_sheet'] ) ) $id_sheet = $_POST['id_sheet'];
            else $id_sheet = $report->getIdSheet();

        if ( isset( $_POST['title'] ) ) $title = $_POST['title'];
            else $title = $report->getTitle();

        if ( isset( $_POST['file'] ) ) $file = $_POST['file'];
            else $file = $report->getFile();

        require('views/admin/report-edit.phtml');
    }

?>