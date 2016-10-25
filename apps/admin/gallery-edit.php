<?php
    if ( isset( $_GET['id'] ) ) {

        $id = $_GET['id'];

        if ( $id == 0 ) {
            $gallery = new Gallery( $link );
            $gallery_action = 'new';
            $gallery->setTitle('image');

        } else {
            $manager = new GalleryManager( $link );
            $gallery = $manager->findById( $id );
            $gallery_action = 'modify';
        }

        if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
            else $id = $gallery->getId();

        if ( isset( $_POST['id_article'] ) ) $id_article = $_POST['id_article'];
            else $id_article = $gallery->getIdArticle();

        if ( isset( $_POST['title'] ) ) $title = $_POST['title'];
            else $title = $gallery->getTitle();

        if ( isset( $_POST['image'] ) ) $image = $_POST['image'];
            else $image = $gallery->getImage();


        require('views/admin/gallery-edit.phtml');
    }

?>