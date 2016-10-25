<?php
    $i = 0;
    $j = 0;
    $count = count( $sheets );
    while ( $i < $count ) {
        $sheet = $sheets[$i];

        if ( $sheet->getMenuOrder() > 0 ) {
            require('views/admin/manage-menus-displayed.phtml');
            $j++;
        }

        $i++;
    }

?>