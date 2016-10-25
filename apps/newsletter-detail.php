<?php
    if ( isset( $_GET['nl'] ) ) {
        $id_newsletter = intval( $_GET['nl'] );
        $manager       = new NewsletterManager( $link );
        $newsletter    = $manager->findById( $id_newsletter );

        if( $newsletter == null ) {
            $newsletter = $manager->findFirst();
        }

        require('views/newsletter-detail.phtml');
    }
?>