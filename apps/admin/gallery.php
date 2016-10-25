<?php
    $i     = 0;
    $count = count( $galleries );
    while ( $i < $count ) {
        $gallery = $galleries[$i];

        require('views/admin/gallery.phtml');

        $i++;
    }


?>