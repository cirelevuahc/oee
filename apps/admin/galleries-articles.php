<?php
    $article_manager = new ArticleManager( $link );
    $articles = $article_manager->findAll();

    require('views/admin/galleries-articles.phtml');
?>