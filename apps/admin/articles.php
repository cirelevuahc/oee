<?php

    $manager = new ArticleManager( $link );

    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    )
        $articles = $manager->findAll();
    else
        $articles = $manager->findAllByIdUser( $_SESSION['user']['id'] );

    $confirm_title  = 'Supprimer';
    $confirm_msg    = 'Etes-vous sûre de vouloir supprimer cet article ?';

    require('views/admin/articles.phtml');

?>