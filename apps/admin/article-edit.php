<?php
    if ( isset( $_GET['id'] ) ) {

        $id = $_GET['id'];

        if ( $id == 0 ) {
            $article = new Article( $link );
            $article_action = 'new';

        } else {
            $manager = new ArticleManager( $link );
            $article = $manager->findById( $id );
            $article_action = 'modify';
        }

        if ( isset( $_POST['id'] ) ) $id = $_POST['id'];
            else $id = $article->getId();

        if ( isset( $_POST['id_sheet'] ) ) $id_sheet = $_POST['id_sheet'];
            else $id_sheet = $article->getIdSheet();

        if ( isset( $_POST['title'] ) ) $title = $_POST['title'];
            else $title = $article->getTitle();

        if ( isset( $_POST['content'] ) ) $content = $_POST['content'];
            else $content = $article->getContent();

        if ( isset( $_POST['image'] ) ) $image = $_POST['image'];
            else $image = $article->getImage();

        if ( isset( $_POST['video'] ) ) $video = $_POST['video'];
            else $video = $article->getVideo();

        if ( isset( $_POST['gallery'] ) ) $gallery = $_POST['gallery'];
            else $gallery = $article->getGallery();

        require('views/admin/article-edit.phtml');
    }

?>