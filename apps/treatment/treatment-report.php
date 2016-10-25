<?php

if ( isset( $_POST['action'] ) ) {

   if ( $_POST['action'] == 'new' ) {

        $manager = new ReportManager( $link );
        try {

            $sheet_manager = new SheetManager( $link );
            $sheet = $sheet_manager->findById( $_POST['id_sheet'] );

            $report = $manager->create( $_POST, $sheet );

            header('Location: reports');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {
        $manager = new ReportManager( $link );
        try {
            $id =  $_POST['id'];
            $report = $manager->findById( $id );

            $report->setIdSheet( $_POST['id_sheet'] );
            $report->setTitle( $_POST['title'] );
            $report->setFile( $_POST['file'] );

            $report = $manager->update( $report );
            header('Location: reports');
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
                $manager = new ReportManager( $link );
                $id =  $_POST['id'];

                $report = $manager->findById( $id );

                $manager->remove( $report );
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