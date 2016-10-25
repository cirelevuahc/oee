<?php
    $link = mysqli_connect( $serveur ,$username, $password, $database );

    if ( mysqli_connect_errno() ) {
        $message['type']    = 'error';
        $message['content'] = 'Pas de connection au serveur';

        require('views/alert-box.phtml');
        exit;
    }
?>