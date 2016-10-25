<?php
    $id_article = 0;
    if ( isset( $_GET['id'] ) ) $id_article = intval( $_GET['id'] );

    $select_limit = intval( $SETTINGS->findByName('select-limit')->getValue() );

    $manager = new GalleryManager( $link );

    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    ) {
        if ( $id_article == 0 ) {
            $list_nav_count = $manager->countAll();
        } else {
            $list_nav_count = $manager->countAllByIdArticle( $id_article );
        }
    } else {
        if ( $id_article == 0 ) {
            $list_nav_count = $manager->countAllByIdUser( $_SESSION['user']['id'] );
        } else {
            $list_nav_count = $manager->countAllByIdUserIdArticle( $_SESSION['user']['id'],$id_article );
        }
    }

    require('apps/admin/list-nav-get-page.php');

    $manager = new GalleryManager( $link, $select_offset, $select_limit );

    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    ) {
        if ( $id_article == 0 ) {
            $galleries = $manager->findAll();
        } else {
            $galleries = $manager->findAllByIdArticle( $id_article );
        }
    } else {
        if ( $id_article == 0 ) {
            $galleries = $manager->findAllByIdUser( $_SESSION['user']['id'] );
        } else {
            $galleries = $manager->findAllByIdUserByIdArticle( $_SESSION['user']['id'], $id_article );
        }
    }

    $list_nav_name = 'galleries';

    $confirm_title  = 'Supprimer';
    $confirm_msg    = 'Etes-vous sûre de vouloir supprimer cette image ?';

    require('views/admin/galleries.phtml');

?>