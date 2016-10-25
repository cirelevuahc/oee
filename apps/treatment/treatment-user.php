<?php

//  if ( !isset( $_SESSION['login'] ) ) return;

if ( isset( $_POST['action'] ) ) {

    if ( $_POST['action'] == 'register' ) {

        $manager = new UserManager( $link );
        try {
            $user        = $manager->create( $_POST );

            $users_admin = $manager->findByIdRole(1);
            $mail_bcc    = array();
            $i           = 0;
            $count       = count( $users_admin);
            while ( $i < $count ) {
                $user_admin = $users_admin[$i];
                $mail_bcc[] = $user_admin->getEmail();
                $i++;
            }

            $bcc = implode( ',', $mail_bcc );
            $site_name = $SETTINGS->findByName('long-name')->getValue();
            send_register_confirmation( $user, $bcc, $site_name );

            header('Location: register-message');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'login' ) {
        $manager = new UserManager( $link );
        try {
            $user = $manager->login( $_POST );

            header('Location: home');
            exit;
        }

        catch (Exception $exception) {
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {

        $manager = new UserManager( $link );
        try {
            $id =  $_POST['id'];
            $user = $manager->findById( $id );

            if ( isset( $_POST['id_role'] ) ) $user->setIdRole( $_POST['id_role'] );
            $user->setName( $_POST['name'] );
            $user->setForname( $_POST['forname'] );
            $user->setEmail( $_POST['email'] );
            $user->setLogin( $_POST['login'] );
            $user->setPseudo( $_POST['pseudo'] );
            if ( isset( $_POST['status'] ) ) $user->setStatus( $_POST['status'] );

            if ( isset( $_POST['modify_password'] ) && $_POST['modify_password'] != '' ) {
                $user->setPassword( password_hash( $_POST['modify_password'], PASSWORD_BCRYPT, array( 'cost' => 8 ) ) );
            }

            if ( isset( $_POST['password'] ) && _POST['password'] != '' ) {
                $user->setPassword( password_hash( $_POST['password'], PASSWORD_BCRYPT, array( 'cost' => 8 ) ) );
            }

            $user = $manager->update( $user );

            header('Location: users');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'new' ) {

        $manager = new UserManager( $link );
        try {
            $_POST['confirme_password'] = $_POST['password'];
            $user = $manager->create( $_POST );

            header('Location: users');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'supp' ) {

        $manager = new UserManager( $link );

        try {
            $id =  $_POST['id'];
            $user = $manager->findById( $id );

            $user->setStatus('2');

            $user = $manager->update( $user );

            header('Location: users');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }
}

if ( isset( $_GET['page'] ) && $_GET['page']  == 'register-confirm' ) {
    if ( isset( $_GET['rc'] ) && $_GET['rc']  != '' ) {
        $rc      = $_GET['rc'];
        $manager = new UserManager( $link );
        try {
            $user = $manager->findByRegisterConfirm( $rc );

            if ( !empty( $user ) ) {
                $user->setStatus( 1 );
                $user->setRegisterConfirm('');

                $user = $manager->update( $user );

                $_SESSION['message']['type']    = 'info';
                $_SESSION['message']['content'] = 'Votre mail à bien été validé, vous pouvez acceder à votre compte.';
            }


        }

        catch ( Exception $exception ) {
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }

        header('Location: login');
        exit;

    }
}

if ( isset( $_GET['page'] ) && $_GET['page']  == 'logout' ) {
    session_destroy();

    header('Location: login');
    exit;
}

?>