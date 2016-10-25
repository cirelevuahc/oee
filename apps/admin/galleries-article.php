<?php
    $i = 0;
    $count = count( $articles );
    while ( $i < $count ) {
        $article = $articles[$i];

        require('views/admin/galleries-article.phtml');

        $i++;
    }

?>