<?php
    $article_manager = new ArticleManager( $link );
    $articles = $article_manager->findAll();

    require('views/admin/gallery-edit-articles.phtml');
?>