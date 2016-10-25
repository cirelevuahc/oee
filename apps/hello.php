<?php
    if ( isset( $_SESSION['user']['status'] ) && $_SESSION['user']['status'] == 1 ) {

        if ( isset( $_SESSION['user']['capability']['member'] ) && $_SESSION['user']['capability']['member'] == 1 ) {
            $pseudo = $_SESSION['user']['pseudo'];
            
            require('views/hello.phtml');
        }
    }
?>