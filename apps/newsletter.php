<?php

    $i     = 0;
    $count = count( $newsletters );
    while ( $i < $count ) {
        $newsletter = $newsletters[$i];

        require('views/newsletter.phtml');

        $i++;
    }


?>