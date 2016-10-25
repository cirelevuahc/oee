<?php
    $i = 0;
    $count = count( $sheets );
    while ( $i < $count ) {
        $sheet = $sheets[$i];

        require('views/admin/article-edit-sheet.phtml');

        $i++;
    }

?>