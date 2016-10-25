<?php
    if ( isset( $_GET['id'] ) ) {

        $id = $_GET['id'];

        if ( $id == 0 ) {
            $sheet = new Sheet( $link );
            $sheet_action = 'new';

        } else {
            $manager = new SheetManager( $link );
            $sheet = $manager->findById( $id );
            $sheet_action = 'modify';
        }

        if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
            else $id = $sheet->getId();

        if ( isset( $_POST['title'] ) ) $title = $_POST['title'];
            else $title = $sheet->getTitle();

        if ( isset( $_POST['content'] ) ) $content = $_POST['content'];
            else $content = $sheet->getContent();

        if ( isset( $_POST['image'] ) ) $image = $_POST['image'];
            else $image = $sheet->getImage();

        if ( isset( $_POST['video'] ) ) $video = $_POST['video'];
            else $video = $sheet->getVideo();

        if ( isset( $_POST['newsletter'] ) ) $newsletter = $_POST['newsletter'];
            else $newsletter = $sheet->getNewsletter();

        if ( isset( $_POST['report'] ) ) $report = $_POST['report'];
            else $report = $sheet->getReport();

        require('views/admin/sheet-edit.phtml');
    }

?>