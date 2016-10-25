<?php
if ( isset( $_POST['action'] ) ) {

    if ( $_POST['action'] == 'send' ) {

        $manager = new UserManager( $link );
        try {

            if ( isset( $_POST['contact_name'] ) ) $contact_name        = $_POST['contact_name'];
            if ( isset( $_POST['contact_forname'] ) ) $contact_forname  = $_POST['contact_forname'];
            if ( isset( $_POST['contact_email'] ) ) $contact_email      = $_POST['contact_email'];
            if ( isset( $_POST['contact_message'] ) ) $contact_message  = $_POST['contact_message'];

            if ( strlen( $contact_name ) < 3 )
                throw new Exception ('Nom trop court (< 3)');
            else if ( strlen( $contact_name ) > 63 )
                throw new Exception ('Nom trop long (> 63)');

            if ( strlen( $contact_forname ) < 3 )
                throw new Exception ('Prénom trop court (< 3)');
            else if ( strlen( $contact_forname ) > 63 )
                throw new Exception ('Prénom trop long (> 63)');

            if ( filter_var( $contact_email, FILTER_VALIDATE_EMAIL ) == false )
                throw new Exception ('Email invalide');

            if ( strlen( $contact_message ) < 3 )
                throw new Exception ('Message trop court (< 3)');
            else if ( strlen( $contact_message ) > 1024 )
                throw new Exception ('Message trop long (> 1024)');


            $site_name = $SETTINGS->findByName('long-name')->getValue();
            $to        = $SETTINGS->findByName('email-contact')->getValue();

            send_message( $to, $contact_name, $contact_forname, $contact_email, $contact_message, $site_name );

            $_SESSION['message']['type']    = 'info';
            $_SESSION['message']['content'] = 'Votre message a bien été envoyé.';

            header('Location: welcome');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }
}

?>