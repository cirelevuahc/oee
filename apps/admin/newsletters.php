<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    ) {
        $manager = new NewsletterManager( $link );

        $newsletters = $manager->findAll();


        $confirm_title  = 'Supprimer';
        $confirm_msg    = 'Etes-vous sûre de vouloir supprimer cet newsletter ?';

        require('views/admin/newsletters.phtml');
    }
?>