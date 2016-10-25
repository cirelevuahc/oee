<?php
    if ( $_SESSION['user']['capability']['editor'] == 1 || $_SESSION['user']['capability']['author'] == 1) {
        if ( isset( $_GET['id'] ) ) {

            $id = $_GET['id'];

            $manager = new UserManager( $link );
            $user = $manager->findById( $id );
            $user_action = 'modify';
            
            if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
                else $id = $user->getId();

            if ( isset( $_POST['name'] ) ) $name = $_POST['name'];
                else $name = $user->getName();

            if ( isset( $_POST['forname'] ) ) $forname = $_POST['forname'];
                else $forname = $user->getForname();

            if ( isset( $_POST['email'] ) ) $email = $_POST['email'];
                else $email = $user->getEmail();

            if ( isset( $_POST['login'] ) ) $login = $_POST['login'];
                else $login = $user->getLogin();

            $password = '';

            if ( isset( $_POST['pseudo'] ) ) $pseudo = $_POST['pseudo'];
                else $pseudo = $user->getPseudo();


            require('views/admin/user-edit-single.phtml');
        }
    }
?>