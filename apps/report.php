<?php

    $i     = 0;
    $count = count( $reports );
    while ( $i < $count ) {
        $report = $reports[$i];

        require('views/report.phtml');

        $i++;
    }


?>