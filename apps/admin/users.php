<?php
    if ( $_SESSION['user']['capability']['admin'] == 1 ) {
        $manager = new UserManager( $link );

        $users = $manager->findAll();

        $confirm_title  = 'Supprimer';
        $confirm_msg    = 'Etes-vous sûre de vouloir supprimer cet utilisateur ?';

        require('views/admin/users.phtml');
    }

?>