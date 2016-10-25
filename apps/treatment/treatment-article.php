<?php

if ( isset( $_POST['action'] ) ) {

   if ( $_POST['action'] == 'new' ) {

        $manager = new ArticleManager( $link );
        try {

            $user_manager = new UserManager( $link );
            $user = $user_manager->findById(  $_SESSION['user']['id'] );

            $sheet_manager = new SheetManager( $link );
            $sheet = $sheet_manager->findById( $_POST['id_sheet'] );

            $article = $manager->create( $_POST, $user, $sheet );

            header('Location: articles');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {
        $manager = new ArticleManager( $link );
        try {
            $id =  $_POST['id'];
            $article = $manager->findById( $id );

            $article->setIdSheet( $_POST['id_sheet'] );
            $article->setTitle( $_POST['title'] );
            $article->setContent( $_POST['content'] );
            $article->setImage( $_POST['image'] );
            $article->setVideo( $_POST['video'] );
            $article->setGallery( $_POST['gallery'] );

            $article = $manager->update( $article );
            header('Location: articles');
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
                $manager = new ArticleManager( $link );
                $id =  $_POST['id'];

                $article = $manager->findById( $id );
   
                $manager->remove( $article );
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