<?php
    if ( isset( $_GET['id'] ) ) {

        $id = $_GET['id'];

        if ( $id == 0 ) {
            $newsletter = new Newsletter( $link );
            $newsletter_action = 'new';

        } else {
            $manager = new NewsletterManager( $link );
            $newsletter = $manager->findById( $id );
            $newsletter_action = 'modify';
        }

        if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
            else $id = $newsletter->getId();

        if ( isset( $_POST['id_sheet'] ) ) $id_sheet = $_POST['id_sheet'];
            else $id_sheet = $newsletter->getIdSheet();

        if ( isset( $_POST['title'] ) ) $title = $_POST['title'];
            else $title = $newsletter->getTitle();

        if ( isset( $_POST['file'] ) ) $file = $_POST['file'];
            else $file = $newsletter->getFile();

        require('views/admin/newsletter-edit.phtml');
    }

?>