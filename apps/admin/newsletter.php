<?php
    $i = 0;
    $count_newsletter = count( $newsletters );
    while ( $i < $count_newsletter ) {
        $newsletter = $newsletters[$i];

        require('views/admin/newsletter.phtml');

        $i++;
    }


?>