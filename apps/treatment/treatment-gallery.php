<?php

if ( isset( $_POST['action'] ) ) {

   if ( $_POST['action'] == 'new' ) {

        $manager = new GalleryManager( $link );
        try {

            $user_manager = new UserManager( $link );
            $user = $user_manager->findById( $_SESSION['user']['id'] );

            $article_manager = new ArticleManager( $link );
            $article = $article_manager->findById( $_POST['id_article'] );

            $gallery = $manager->create( $_POST, $article, $user );

            header('Location: galleries');
            exit;
        }

        catch ( Exception $exception ){
            $message['type']    = 'erreur';
            $message['content'] =  $exception->getMessage();
        }
    }

    if ( $_POST['action'] == 'modify' ) {
        $manager = new GalleryManager( $link );
        try {
            $id =  $_POST['id'];
            $gallery = $manager->findById( $id );
            $gallery->setIdArticle( $_POST['id_article'] );
            $gallery->setTitle( $_POST['title'] );
            $gallery->setImage( $_POST['image'] );

            $gallery = $manager->update( $gallery );
            header('Location: galleries');
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
                $manager = new GalleryManager( $link );
                $id =  $_POST['id'];
                $gallery = $manager->findById( $id );
                $manager->remove( $gallery );
            }

            catch (Exception $exception) {
               $message['type']    = 'erreur';
               $message['content'] =  $exception->getMessage();
            }
        }
    }

    if ( $_POST['action'] == 'upload-image' && $_FILES['image_upload']['name'] ) {
        $message = upload_image('galleries');
    }

}

?>