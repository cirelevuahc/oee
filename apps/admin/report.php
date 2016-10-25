<?php
    $i = 0;
    $count_report = count( $reports );
    while ( $i < $count_report ) {
        $report = $reports[$i];

        require('views/admin/report.phtml');

        $i++;
    }


?>