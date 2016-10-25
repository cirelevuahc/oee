<?php

if ( isset( $_POST['action'] ) ) {

   if ( $_POST['action'] == 'new' ) {

        $manager = new SheetManager( $link );
        try {

            $user_manager = new UserManager( $link );
            $user = $user_manager->findById( $_SESSION['user']['id'] );

            $sheet = $manager->create( $_POST, $user );

            header('Location: sheets');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {
        $manager = new SheetManager( $link );
        try {
            $id =  $_POST['id'];
            $sheet = $manager->findById( $id );

            $sheet->setTitle( $_POST['title'] );
            $sheet->setContent( $_POST['content'] );
            $sheet->setImage( $_POST['image'] );
            $sheet->setVideo( $_POST['video'] );
            $sheet->setNewsletter( $_POST['newsletter'] );
            $sheet->setReport( $_POST['report'] );

            $sheet = $manager->update( $sheet );
            header('Location: sheets');
            exit;
        }

        catch (Exception $exception) {
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify-menu-order' ) {
        $manager = new SheetManager( $link );
        try {
            $menu_order =  explode( ';', $_POST['menu_order'] );
            $sheets = $manager->findAll();

            $i     = 0;
            $count = count( $sheets );
            while ( $i < $count ) {
               $sheet = $sheets[$i];

               $id = $sheet->getId();

               if ( in_array( $id, $menu_order ) ) {
                  $key = array_search( $id, $menu_order ) + 1;
               } else {
                  $key = 0;
               }

               $sheet->setMenuOrder( $key );
               $sheet = $manager->update( $sheet );

               $i++;
            }

            header('Location: manage-menus');
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
                $manager = new SheetManager( $link );
                $id =  $_POST['id'];
                $sheet = $manager->findById( $id );
                $manager->remove( $sheet );
            }

            catch (Exception $exception) {
               $message['type']    = 'erreur';
               $message['content'] =  $exception->getMessage();
            }
        }
    }

    if ( $_POST['action'] == 'upload-image' && $_FILES['image_upload']['name'] ) {
        $message = upload_image();
    }

    if ( $_POST['action'] == 'upload-video' && $_FILES['video_upload']['name'] ) {
        $message = upload_video();
    }

}

?>