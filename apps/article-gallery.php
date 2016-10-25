<?php
    $j = 0;
    $count_galleries = count( $galleries );
    while ( $j < $count_galleries ) {
        $gallery = $galleries[$j];

        require('views/article-gallery.phtml');

        $j++;
    }

?>