<?php
    $j = 0;
    $count_sheets = count( $sheets );
    while ( $j < $count_sheets ) {
        $sheet = $sheets[$j];

        require('views/admin/report-edit-sheet.phtml');

        $j++;
    }

?>