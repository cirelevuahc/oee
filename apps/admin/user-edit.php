<?php
    if ( $_SESSION['user']['capability']['admin'] == 1 ) {
        if ( isset( $_GET['id'] ) ) {

            $id = $_GET['id'];

            if ( $id == 0 ) {
                $user = new User( $link );
                $user_action = 'new';

            } else {
                $manager = new UserManager( $link );
                $user = $manager->findById( $id );
                $user_action = 'modify';
            }

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

            if ( isset( $_POST['id_role'] ) ) $id_role = $_POST['id_role'];
                else $id_role = $user->getIdRole();

            if ( isset( $_POST['status'] ) ) $status = $_POST['pseudo'];
                else $status = $user->getStatus();

            require('views/admin/user-edit.phtml');
        }
    }
?>