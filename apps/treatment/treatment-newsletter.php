<?php

if ( isset( $_POST['action'] ) ) {

   if ( $_POST['action'] == 'new' ) {

        $manager = new NewsletterManager( $link );
        try {

            $sheet_manager = new SheetManager( $link );
            $sheet = $sheet_manager->findById( $_POST['id_sheet'] );

            $newsletter = $manager->create( $_POST, $sheet );

            header('Location: newsletters');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {
        $manager = new NewsletterManager( $link );
        try {
            $id =  $_POST['id'];
            $newsletter = $manager->findById( $id );

            $newsletter->setIdSheet( $_POST['id_sheet'] );
            $newsletter->setTitle( $_POST['title'] );
            $newsletter->setFile( $_POST['file'] );

            $newsletter = $manager->update( $newsletter );
            header('Location: newsletters');
            exit;
        }

        catch (Exception $exception) {
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'supp' ) {
        if ( isset( $_POST['id'] ) ) {
            try {
                $manager = new NewsletterManager( $link );
                $id =  $_POST['id'];

                $newsletter = $manager->findById( $id );

                $manager->remove( $newsletter );
            }

            catch (Exception $exception) {
                $message['type']    = 'erreur';
                $message['content'] =  $exception->getMessage();
            }
        }
    }

    if ( $_POST['action'] == 'upload-file' && $_FILES['file_upload']['name'] ) {
        $message = upload_file();
    }


}

?>