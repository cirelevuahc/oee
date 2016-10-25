<?php

    $manager    = new ArticleManager( $link );
    $articles   = $manager->findBySheet( $sheet );
    require('views/articles.phtml');

?>